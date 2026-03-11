<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bab;
use App\Models\Grant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@social.dz',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Sample Babs
        $babGrant = Bab::create(['name' => 'هبات', 'type' => 'grant']);
        $babLoanFull = Bab::create(['name' => 'سلفيات كاملة', 'type' => 'loan_full']);
        $babLoanPartial = Bab::create(['name' => 'سلفيات جزئية', 'type' => 'loan_partial']);

        // Sample Grants
        Grant::create([
            'bab_id' => $babGrant->id,
            'name' => 'منحة زواج',
            'amount' => 30000.00,
            'conditions' => 'أن يكون الموظف مرسماً',
            'required_documents' => 'عقد زواج، بطاقة التعريف',
        ]);

        Grant::create([
            'bab_id' => $babLoanFull->id,
            'name' => 'سلفة زواج',
            'amount' => 50000.00,
            'repayment_percentage' => 100,
            'installments_count' => 10,
            'conditions' => 'ألا يكون لديه سلفة سابقة',
            'required_documents' => 'ملف كامل',
        ]);
    }
}
