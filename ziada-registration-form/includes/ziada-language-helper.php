<?php
function ziada_get_string($key) {
    $lang = get_option('ziada_form_language', 'en');
    $strings = [
        'en' => [
            // General
            'next' => 'Next', 'prev' => 'Previous', 'submit' => 'Submit Application',
            // Step 1
            'step1_title' => 'Account Details',
            'account_type' => 'Account Type',
            'individual' => 'Individual', 'joint' => 'Joint', 'company' => 'Company', 'minor' => 'Minor',
            'investor_1_info' => "1st Investor's Information",
            'first_name' => 'First Name', 'middle_name' => 'Middle Name', 'last_name' => 'Last Name',
            'dob' => 'Date of Birth', 'gender' => 'Gender', 'male' => 'Male', 'female' => 'Female',
            'nationality' => 'Nationality', 'id_type' => 'ID Type', 'nida' => 'NIDA', 'passport' => 'Passport', 'drivers_license' => "Driver's License", 'election_card' => 'Election Card',
            'id_number' => 'ID Number', 'mobile_no' => 'Mobile No', 'email' => 'Email',
            'photo' => 'Passport Size Photo',
            // Step 2
            'step2_title' => 'Applicant Details',
            'investor_2_info' => "2nd Investor's Information",
            'company_info' => 'Company/Institution Information',
            'guardian_info' => 'Parent/Guardian Information',
            // ... and so on for all other fields in all other steps
        ],
        'sw' => [
            // General
            'next' => 'Inayofuata', 'prev' => 'Iliyopita', 'submit' => 'Tuma Maombi',
            // Step 1
            'step1_title' => 'Taarifa za Akaunti',
            'account_type' => 'Aina ya Akaunti',
            'individual' => 'Binafsi', 'joint' => 'Akaunti ya Pamoja', 'company' => 'Kampuni', 'minor' => 'Mtoto',
            'investor_1_info' => 'Taarifa ya Mwekezaji wa Kwanza',
            'first_name' => 'Jina la Kwanza', 'middle_name' => 'Jina la Kati', 'last_name' => 'Jina la Ukoo',
            'dob' => 'Tarehe ya Kuzaliwa', 'gender' => 'Jinsia', 'male' => 'Mwanaume', 'female' => 'Mwanamke',
            'nationality' => 'Uraia', 'id_type' => 'Aina ya Kitambulisho', 'nida' => 'NIDA', 'passport' => 'Pasipoti', 'drivers_license' => 'Leseni ya Udereva', 'election_card' => 'Kadi ya Mpiga Kura',
            'id_number' => 'Namba ya Kitambulisho', 'mobile_no' => 'Namba ya Simu', 'email' => 'Barua Pepe',
            'photo' => 'Picha ya Passport',
            // Step 2
            'step2_title' => 'Taarifa za Mwombaji',
            'investor_2_info' => 'Taarifa ya Mwekezaji wa Pili',
            'company_info' => 'Taarifa za Kampuni/Taasisi',
            'guardian_info' => 'Taarifa za Mzazi/Mlezi',
            // ... and so on for all other fields in all other steps
        ]
    ];
    return isset($strings[$lang][$key]) ? $strings[$lang][$key] : $key;
}