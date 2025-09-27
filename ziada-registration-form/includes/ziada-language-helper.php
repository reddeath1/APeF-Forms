<?php
function ziada_get_string($key) {
    $lang = get_option('ziada_form_language', 'en');
    $strings = [
        'en' => [
            // General
            'next' => 'Next', 'prev' => 'Previous', 'submit' => 'Submit Application',
            // Steps
            'step1_title' => 'Account Details', 'step2_title' => 'Applicant Details', 'step3_title' => 'Contact & Bank Details', 'step4_title' => 'Financials & Nominees', 'step5_title' => 'Payment & Declaration',
            // Section Titles
            'account_type' => 'Account Type', 'investor_1_info' => "1st Investor's Information", 'investor_2_info' => "2nd Investor's Information", 'company_info' => 'Company Information', 'guardian_info' => 'Parent/Guardian Information', 'contact_info' => 'Contact Information', 'bank_details' => "Investor's Bank Details", 'income_source' => 'Source of Income', 'nominees' => 'Details of Nominees', 'nominee_guardian' => 'Guardian Info for Nominees', 'payment_details' => 'Payment Details', 'declaration' => 'Declaration',
            // Labels
            'individual' => 'Individual', 'joint' => 'Joint', 'company' => 'Company', 'minor' => 'Minor',
            'first_name' => 'First Name', 'middle_name' => 'Middle Name', 'last_name' => 'Last Name',
            'dob' => 'Date of Birth', 'gender' => 'Gender', 'male' => 'Male', 'female' => 'Female',
            'nationality' => 'Nationality', 'id_type' => 'ID Type', 'nida' => 'NIDA', 'passport' => 'Passport', 'drivers_license' => "Driver's License", 'election_card' => 'Election Card',
            'id_number' => 'ID Number', 'mobile_no' => 'Mobile No', 'email' => 'Email', 'photo' => 'Passport Size Photo',
            'company_name' => 'Company Name', 'reg_no' => 'Registration No.', 'tin_cert' => 'TIN Certificate No.',
            'postal_address' => 'Postal Address', 'physical_address' => 'Physical Address', 'house_no' => 'House No.', 'district' => 'District', 'region' => 'Region', 'country' => 'Country',
            'bank_name' => 'Bank Name', 'bank_branch' => 'Bank Branch', 'bank_acc_name' => 'Account Name', 'bank_acc_no' => 'Account Number',
            'salary' => 'Salary', 'business' => 'Business', 'others' => 'Others', 'specify_other' => 'Please specify if Others',
            'nominee_name' => 'Full Name', 'nominee_dob' => 'Date of Birth', 'nominee_ownership' => '% of Ownership', 'nominee_relation' => 'Relationship',
            'amount_figures' => 'Amount Paid (Figures)', 'amount_words' => 'Amount Paid (Words)', 'units_bought' => 'Number of Units Bought',
            'declaration_text' => 'I/We confirm that the information provided herein is true, complete and accurate to the best of my/our knowledge.',
        ],
        'sw' => [
            // General
            'next' => 'Inayofuata', 'prev' => 'Iliyopita', 'submit' => 'Tuma Maombi',
            // Steps
            'step1_title' => 'Taarifa za Akaunti', 'step2_title' => 'Taarifa za Mwombaji', 'step3_title' => 'Mawasiliano na Taarifa za Kibenki', 'step4_title' => 'Fedha na Warithi', 'step5_title' => 'Malipo na Uthibitisho',
            // Section Titles
            'account_type' => 'Aina ya Akaunti', 'investor_1_info' => 'Taarifa ya Mwekezaji wa Kwanza', 'investor_2_info' => 'Taarifa ya Mwekezaji wa Pili', 'company_info' => 'Taarifa za Kampuni', 'guardian_info' => 'Taarifa za Mzazi/Mlezi', 'contact_info' => 'Taarifa za Mawasiliano', 'bank_details' => 'Taarifa za Kibenki za Mwekezaji', 'income_source' => 'Chanzo cha Kipato', 'nominees' => 'Taarifa za Warithi', 'nominee_guardian' => 'Taarifa za Mlezi wa Mrithi', 'payment_details' => 'Taarifa za Malipo', 'declaration' => 'Tamko la Uthibitisho',
            // Labels
            'individual' => 'Binafsi', 'joint' => 'Akaunti ya Pamoja', 'company' => 'Kampuni', 'minor' => 'Mtoto',
            'first_name' => 'Jina la Kwanza', 'middle_name' => 'Jina la Kati', 'last_name' => 'Jina la Ukoo',
            'dob' => 'Tarehe ya Kuzaliwa', 'gender' => 'Jinsia', 'male' => 'Mwanaume', 'female' => 'Mwanamke',
            'nationality' => 'Uraia', 'id_type' => 'Aina ya Kitambulisho', 'nida' => 'NIDA', 'passport' => 'Pasipoti', 'drivers_license' => 'Leseni ya Udereva', 'election_card' => 'Kadi ya Mpiga Kura',
            'id_number' => 'Namba ya Kitambulisho', 'mobile_no' => 'Namba ya Simu', 'email' => 'Barua Pepe', 'photo' => 'Picha ya Passport',
            'company_name' => 'Jina la Kampuni', 'reg_no' => 'Namba ya Usajili', 'tin_cert' => 'Namba ya Cheti cha TIN',
            'postal_address' => 'Anuani ya Posta', 'physical_address' => 'Anuani ya Makazi', 'house_no' => 'Namba ya Nyumba', 'district' => 'Wilaya', 'region' => 'Mkoa', 'country' => 'Nchi',
            'bank_name' => 'Jina la Benki', 'bank_branch' => 'Tawi la Benki', 'bank_acc_name' => 'Jina la Akaunti', 'bank_acc_no' => 'Namba ya Akaunti',
            'salary' => 'Mshahara', 'business' => 'Biashara', 'others' => 'Vinginevyo', 'specify_other' => 'Tafadhali taja kama Vinginevyo',
            'nominee_name' => 'Jina Kamili', 'nominee_dob' => 'Tarehe ya Kuzaliwa', 'nominee_ownership' => 'Asilimia ya Umiliki (%)', 'nominee_relation' => 'Uhusiano',
            'amount_figures' => 'Kiasi Kilicholipwa (Tarakimu)', 'amount_words' => 'Kiasi Kilicholipwa (Maneno)', 'units_bought' => 'Idadi ya Vipande Vilivyonunuliwa',
            'declaration_text' => 'Mimi/Sisi tunathibitisha kwamba taarifa zilizo hapa ni za kweli, kamilifu na sahihi kwa kadri ya ufahamu wangu/wetu.',
        ]
    ];
    return isset($strings[$lang][$key]) ? $strings[$lang][$key] : str_replace('_', ' ', $key);
}