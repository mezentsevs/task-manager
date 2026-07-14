<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();
        $user = User::where('email', 'user@example.com')->first();

        $adminTasks = [
            ['title' => 'Admin: Review new Laravel service provider architecture', 'description' => 'Study and review the new service provider architecture in Laravel 11.', 'due_date' => '2026-07-11', 'status' => 'completed'],
            ['title' => 'Admin: Refactor API error handling with custom exceptions', 'description' => 'Implement custom exception classes for consistent API error responses.', 'due_date' => '2026-07-12', 'status' => 'completed'],
            ['title' => 'Admin: Optimize Eloquent queries for task listing', 'description' => 'Use eager loading and query scopes to optimize task list performance.', 'due_date' => '2026-07-22', 'status' => 'in_progress'],
            ['title' => 'Admin: Add input validation rules for due_date field', 'description' => 'Add proper date validation rules to task form requests.', 'due_date' => '2026-07-12', 'status' => 'completed'],
            ['title' => 'Admin: Write unit tests for TaskPolicy', 'description' => 'Cover all policy methods with unit tests for role-based access.', 'due_date' => null, 'status' => 'pending'],
            ['title' => 'Admin: Set up CI/CD pipeline with GitHub Actions', 'description' => 'Automate testing and deployment with GitHub Actions workflows.', 'due_date' => '2026-07-30', 'status' => 'in_progress'],
            ['title' => 'Admin: Migrate database from MySQL to SQLite for local dev', 'description' => 'Switch local development database to SQLite for simplicity.', 'due_date' => '2026-07-11', 'status' => 'completed'],
            ['title' => 'Admin: Implement debounced search with URL query sync', 'description' => 'Add debounced search input and sync filters to URL query parameters.', 'due_date' => '2026-07-12', 'status' => 'completed'],
            ['title' => 'Admin: Design responsive dashboard layout with Tailwind', 'description' => 'Create a responsive dashboard layout using Tailwind CSS grid system.', 'due_date' => null, 'status' => 'pending'],
            ['title' => 'Admin: Update Scribe API documentation for new endpoints', 'description' => 'Regenerate API documentation after adding task endpoints.', 'due_date' => '2026-07-16', 'status' => 'in_progress'],
        ];

        $userTasks = [
            ['title' => 'User: Add user profile settings page', 'description' => 'Create a settings page for users to update their profile information.', 'due_date' => '2026-07-17', 'status' => 'in_progress'],
            ['title' => 'User: Build a reusable modal component for forms', 'description' => 'Extract modal logic into a reusable Vue component with slots and props.', 'due_date' => '2026-07-11', 'status' => 'completed'],
            ['title' => 'User: Write end-to-end tests for registration flow', 'description' => 'Add Cypress tests covering the full user registration process.', 'due_date' => null, 'status' => 'pending'],
            ['title' => 'User: Research Vue Toast notification libraries', 'description' => 'Compare popular Vue toast libraries for future integration.', 'due_date' => null, 'status' => 'pending'],
            ['title' => 'User: Improve accessibility for screen readers', 'description' => 'Add ARIA labels and semantic HTML to improve screen reader support.', 'due_date' => '2026-07-12', 'status' => 'completed'],
            ['title' => 'User: Refactor Pinia store to use composition API', 'description' => 'Refactor auth and task stores to use the Composition API style.', 'due_date' => '2026-07-29', 'status' => 'in_progress'],
            ['title' => 'User: Add loading skeletons for task list', 'description' => 'Implement skeleton loaders while task data is being fetched.', 'due_date' => null, 'status' => 'pending'],
            ['title' => 'User: Implement dark mode toggle persistence', 'description' => 'Save theme preference in localStorage and apply on page load.', 'due_date' => '2026-07-13', 'status' => 'completed'],
            ['title' => 'User: Write Storybook stories for UI components', 'description' => 'Document UI components with Storybook stories and variants.', 'due_date' => null, 'status' => 'pending'],
            ['title' => 'User: Fix mobile navigation overlap issue', 'description' => 'Resolve z-index and positioning conflicts on mobile screens.', 'due_date' => '2026-07-23', 'status' => 'in_progress'],
        ];

        foreach ($userTasks as $task) {
            Task::create([
                'user_id' => $user->id,
                'title' => $task['title'],
                'description' => $task['description'],
                'due_date' => $task['due_date'],
                'status' => $task['status'],
            ]);
        }

        foreach ($adminTasks as $task) {
            Task::create([
                'user_id' => $admin->id,
                'title' => $task['title'],
                'description' => $task['description'],
                'due_date' => $task['due_date'],
                'status' => $task['status'],
            ]);
        }
    }
}
