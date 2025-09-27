<?php
function ziada_get_string($key) {
    $lang = get_option('ziada_form_language', 'en');

$strings = [
    'en' => [
        // General
        'next' => 'Next',
        'prev' => 'Previous',
        'submit' => 'Submit Application',
        'declaration' => 'Declaration',
        'declaration_text' => 'I hereby declare that the information provided is true and correct to the best of my knowledge.',

        // Step 1
        'step1_title' => 'Account Details',
        'account_type' => 'Account Type',
        'individual' => 'Individual',
        'joint' => 'Joint',
        'company' => 'Company',
        'institution' => 'Institution',
        'group' => 'Group',
        'minor' => 'Minor',

        'investor_1_info' => "1ST INVESTOR’S INFORMATION",
        'first_name' => 'First Name',
        'middle_name' => 'Middle Name',
        'last_name' => 'Last Name',
        'dob' => 'Date of Birth',
        'gender' => 'Gender',
        'male' => 'Male',
        'female' => 'Female',
        'nationality' => 'Nationality',
        'id_type' => 'ID Type',
        'nida' => 'NIDA',
        'passport' => 'Passport',
        'drivers_license' => "Driver's License",
        'election_card' => 'Election Card',
        'id_number' => 'ID Number',
        'mobile_no' => 'Mobile No',
        'email' => 'Email',
        'photo' => 'Passport Size Photo',

        // Step 2
        'step2_title' => 'Applicant Details',
        'investor_2_info' => "2ND INVESTOR’S INFORMATION",
        'company_info' => 'Company/Institution/Group Information',
        'guardian_info' => 'Parent/Guardian Information',
        'company_reg_no' => 'Namba ya Usajili',
        'company_phone_number' => 'Namba ya Simu ya Kampuni',
        'company_type' => 'Aina ya Biashara',
        'company_country' => 'Nchi ya Usajili',
        'company_reg_cert' => 'Cheti cha Usajili',
        'company_email' => 'Barua Pepe ya Kampuni',
        'company_name' => 'Company Name/Institution/Group',

        // Step 3
        'step3_title' => 'Contact & Bank Details',
        'contact_info' => 'CONTACT INFORMATION',
        'postal_address' => 'Postal Address',
        'physical_address' => 'Physical Address',
        'house_no' => 'House No',
        'district' => 'District',
        'region' => 'Region',
        'country' => 'Country',
        'bank_details' => "INVESTOR'S BANK DETAILS",
        'bank_name' => 'Bank Name',
        'bank_branch' => 'Bank Branch',
        'bank_acc_name' => 'Account Name',
        'bank_acc_no' => 'Account Number',

        // Step 4
        'step4_title' => 'Financials & Nominees',
        'income_source' => 'SOURCE OF INCOME',
        'salary' => 'Salary',
        'business' => 'Business',
        'others' => 'Others',
        'income_others_specify' => 'Please Specify if You have Chosen Others',
        'nominees' => 'DETAILS OF NOMINEES',
        'nominee_name' => 'Full Name',
        'nominee_dob' => 'Date of Birth',
        'nominee_ownership' => 'Ownership (%)',
        'nominee_relation' => 'Relationship',
        'add_nominee' => 'Add Another Nominee',
        'guardian_nominee_info' => 'GUARDIAN CONTACT INFORMATION FOR NOMINEES',
        'nominee_guardian_name' => 'Full Name',
        'nominee_guardian_dob' => 'Date of Birth',
        'nominee_guardian_address' => 'Physical Address',
        'nominee_guardian_phone' => 'Mobile No',
        'is_required' => 'is required',   // in English
        'please_select' => 'Please select',
        // Step 5
        'step5_title' => 'Declaration',
    ],

    'sw' => [
        // General
        'next' => 'Inayofuata',
        'prev' => 'Iliyopita',
        'submit' => 'Tuma Maombi',
        'declaration' => 'Tamko',
        'declaration_text' => 'Ninatamka kwamba taarifa nilizotoa ni za kweli na sahihi kwa ufahamu wangu wote.',

        // Step 1
        'step1_title' => 'Taarifa za Akaunti',
        'account_type' => 'Aina ya Akaunti',
        'individual' => 'Binafsi',
        'joint' => 'Akaunti ya Pamoja',
        'company' => 'Kampuni',
        'institution' => 'Taasisi',
        'group' => 'Kikundi',
        'minor' => 'Mtoto',

        'investor_1_info' => 'SEHEMU A: TAARIFA YA MWEKEZAJI WA KWANZA',
        'first_name' => 'Jina la Kwanza',
        'middle_name' => 'Jina la Kati',
        'last_name' => 'Jina la Ukoo',
        'dob' => 'Tarehe ya Kuzaliwa',
        'gender' => 'Jinsia',
        'male' => 'Mwanaume',
        'female' => 'Mwanamke',
        'nationality' => 'Uraia',
        'id_type' => 'Aina ya Kitambulisho',
        'nida' => 'NIDA',
        'passport' => 'Pasipoti',
        'drivers_license' => 'Leseni ya Udereva',
        'election_card' => 'Kadi ya Mpiga Kura',
        'id_number' => 'Namba ya Kitambulisho',
        'mobile_no' => 'Namba ya Simu',
        'email' => 'Barua Pepe',
        'photo' => 'Picha ya Passport',

        // Step 2
        'step2_title' => 'Taarifa za Mwombaji',
        'investor_2_info' => 'SEHEMU B: TAARIFA YA MWEKEZAJI WA PILI',
        'company_info' => 'SEHEMU C: TAARIFA ZA KAMPUNI/Taasisi/KIKUNDI',
        'guardian_info' => 'SEHEMU D: TAARIFA ZA MZAZI/MLEZI',

        'company_reg_no' => 'Namba ya Usajili',
        'company_name' => 'Jina la Kampuni/Taasisi/Kikundi',
        'company_type' => 'Aina ya Biashara',
        'company_country' => 'Nchi ya Usajili',
        'company_reg_cert' => 'Cheti cha Usajili',
        'company_email' => 'Barua Pepe ya Kampuni',
        'company_phone_number' => 'Company Phone Number',
        // Step 3
        'step3_title' => 'Taarifa za Mawasiliano na Kibenki',
        'contact_info' => 'SEHEMU E: TAARIFA ZA MAWASILIANO',
        'postal_address' => 'Sanduku la Posta',
        'physical_address' => 'Anuani ya Makazi',
        'house_no' => 'Namba ya Nyumba',
        'district' => 'Wilaya',
        'region' => 'Mkoa',
        'country' => 'Nchi',
        'bank_details' => 'SEHEMU F: TAARIFA ZA KIBENKI ZA MWEKEZAJI',
        'bank_name' => 'Jina la Benki',
        'bank_branch' => 'Tawi la Benki',
        'bank_acc_name' => 'Jina la Akaunti',
        'bank_acc_no' => 'Nambari ya Akaunti',

        // Step 4
        'step4_title' => 'Taarifa za Kifedha na Warithi',
        'income_source' => 'SEHEMU G: CHANZO CHA KIPATO',
        'salary' => 'Mshahara',
        'business' => 'Biashara',
        'others' => 'Vyanzo Vinginevyo',
        'income_others_specify' => 'Tafadhali eleza ikiwa umechagua Vinginevyo',
        'nominees' => 'SEHEMU H: TAARIFA ZA WARITHI',
        'nominee_name' => 'Jina Kamili',
        'nominee_dob' => 'Tarehe ya Kuzaliwa',
        'nominee_ownership' => 'Asilimia ya Umiliki (%)',
        'nominee_relation' => 'Uhusiano',
        'add_nominee' => 'Ongeza Mrithi Mwingine',
        'guardian_nominee_info' => 'TAARIFA ZA MLEZI WA WARITHI',
        'nominee_guardian_name' => 'Jina Kamili',
        'nominee_guardian_dob' => 'Tarehe ya Kuzaliwa',
        'nominee_guardian_address' => 'Anuani ya Makazi',
        'nominee_guardian_phone' => 'Namba ya Simu',
        'is_required' => 'inahitajika',   // in Swahili
        'please_select' => 'Tafadhali chagua',
        // Step 5
        'step5_title' => 'Tamko',
    ]
];

    return isset($strings[$lang][$key]) ? $strings[$lang][$key] : $key;
}