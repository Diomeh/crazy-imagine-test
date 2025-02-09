<?php

namespace App\Console\Commands;

use App\Jobs\StoreEmployeeData;
use Illuminate\Console\Command;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Throwable;

class FetchData extends Command
{
    const string API_ENDPOINT = "http://dummy.restapiexample.com/api/v1/employees";

    /**
     * API endpoint dummy response,
     * needed for test as endpoint fails constantly with 409 or 429 HTTP errors.
     * Taken from an actual successful response to endpoint
     * 'id' field has been removed
     */
    const DUMMY_RESPONSE = '{
        "status": "success",
        "data": [
            {
                "employee_name": "Tiger Nixon",
                "employee_salary": 320800,
                "employee_age": 61,
                "profile_image": ""
            },
            {
                "employee_name": "Garrett Winters",
                "employee_salary": 170750,
                "employee_age": 63,
                "profile_image": ""
            },
            {
                "employee_name": "Ashton Cox",
                "employee_salary": 86000,
                "employee_age": 66,
                "profile_image": ""
            },
            {
                "employee_name": "Cedric Kelly",
                "employee_salary": 433060,
                "employee_age": 22,
                "profile_image": ""
            }
        ],
        "message": "Successfully! All records have been fetched."
    }';

    /**
     * The name and signature of the console command.
     *
     * The debug option allows to use hardcoded dummy response in case of failure.
     *
     * @var string
     */
    protected $signature = 'fetch-data {--d|debug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches dummy data from API endpoint to populate `employees` table';

    /**
     * Execute the console command.
     * @throws Throwable
     */
    public function handle(): void
    {
        $this->info('Fetching data from API...');
        if ($this->option('debug')) {
            $this->info('Running on debug mode');
        }

        $response = Http::get(self::API_ENDPOINT);

        $json = $this->getJson($response);
        if (!$json) {
            $this->fail("Failed to fetch data from the API with HTTP status code [{$response->status()}]");
        }

        $employees = $this->parseEmployees($json);
        StoreEmployeeData::dispatch($employees);
        $this->info('Data fetched and job dispatched successfully!');
    }

    /**
     * Retrieves JSON from response
     *
     * @param Response $response
     * @return mixed An array with decoded response JSON or NULL
     */
    private function getJson(Response $response): mixed
    {
        if ($response->successful()) {
            return $response->json();
        }

        // Endpoint tends to fail a lot
        // Specially with 409 errors on sail/docker
        // and 429 errors on browser/postman
        // So for test purposes we bypass this
        // using a debug option
        if ($this->option('debug')) {
            $this->warn('Could not fetch data from API; using dummy data...');
            return json_decode(self::DUMMY_RESPONSE);
        }

        return null;
    }

    /**
     * Maps the fetched records from API endpoint into the keys the model and table expect
     *
     * @param array $json Response data as JSON
     * @return array
     */
    private function parseEmployees(array $json): array
    {
        return array_map(function ($item) {
            return [
                // On dummy data, id field does not exist
                'id' => $item['id'] ?? '',
                'name' => $item['employee_name'],
                'age' => $item['employee_salary'],
                'salary' => $item['employee_age'],
                'profile_picture' => $item['profile_image'],
            ];
        }, $json['data']);
    }
}
