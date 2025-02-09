<?php

namespace App\Jobs;

use App\Models\Employee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class StoreEmployeeData implements ShouldQueue
{
    use Queueable;

    /**
     * @var array $employeeData;
     */
    protected array $employeeData;

    /**
     * Create a new job instance.
     *
     * @param array $employeeData
     * @return void
     */
    public function __construct(array $employeeData)
    {
        $this->employeeData = $employeeData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        foreach ($this->employeeData as $data) {
            $arr = [
                'id' => $data['id'],
                'name' => $data['name'] ?? 'N/A',
                'age' => $data['age'] ?? 0,
                'salary' => $data['salary'] ?? 0.0,
                'profile_picture' => $data['profile_picture'] ?? '',
            ];

            // Cleanup id field to avoid problems when inserting into db
            if (!$arr['id']) {
                unset($arr['id']);
            }

            Employee::create($arr);
        }
    }
}
