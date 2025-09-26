<?php
function ziada_get_string($key) {
    $lang = get_option('ziada_form_language', 'en');
    $strings = [
        'en' => [
            // Step 1
            'step1' => 'Step 1 of 5: Account Details',
            'account_type' => 'Account Type',
            'individual' => 'Individual', 'joint' => 'Joint', 'company' => 'Company', 'minor' => 'Minor',
            'investor_1_info' => "1st Investor's Information",
            'first_name' => 'First Name', 'middle_name' => 'Middle Name', 'last_name' => 'Last Name',
            'dob' => 'Date of Birth', 'gender' => 'Gender', 'male' => 'Male', 'female' => 'Female',
            'nationality' => 'Nationality', 'id_type' => 'Identification Type', 'nida' => 'NIDA', 'passport' => 'Passport', 'drivers_license' => "Driver's License", 'election_card' => 'Election Card',
            'id_number' => 'Identification Number', 'mobile_no' => 'Mobile No', 'email' => 'Email',
            'photo' => 'Passport Size Photo',
            // ... all other strings for all steps
        ],
        'sw' => [
            // Step 1
            'step1' => 'Hatua ya 1 kati ya 5: Taarifa za Akaunti',
            'account_type' => 'Aina ya Akaunti',
            'individual' => 'Binafsi', 'joint' => 'Akaunti ya Pamoja', 'company' => 'Kampuni', 'minor' => 'Mtoto',
            'investor_1_info' => 'Taarifa ya Mwekezaji wa Kwanza',
            'first_name' => 'Jina la Kwanza', 'middle_name' => 'Jina la Kati', 'last_name' => 'Jina la Ukoo',
            'dob' => 'Tarehe ya Kuzaliwa', 'gender' => 'Jinsia', 'male' => 'Mwanaume', 'female' => 'Mwanamke',
            'nationality' => 'Uraia', 'id_type' => 'Aina ya Kitambulisho', 'nida' => 'Kitambulisho cha Uraia (NIDA)', 'passport' => 'Pasipoti', 'drivers_license' => 'Leseni ya Udereva', 'election_card' => 'Kadi ya Mpiga Kura',
            'id_number' => 'Namba ya Kitambulisho', 'mobile_no' => 'Namba ya Simu', 'email' => 'Barua Pepe',
            'photo' => 'Picha ya Passport',
            // ... all other strings for all steps
        ]
    ];
    return isset($strings[$lang][$key]) ? $strings[$lang][$key] : '...';
}