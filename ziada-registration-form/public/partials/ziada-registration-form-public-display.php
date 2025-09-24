<!--
This file is rendered by the [ziada_registration_form] shortcode.
The necessary styles and scripts are enqueued by the plugin's main class.
-->
<style>
    /* Custom styles for the form */
    #ziada-reg-form {
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        background: #fff;
    }
    .form-step {
        display: none;
    }
    .form-step.active {
        display: block;
        animation: fadeIn 0.5s;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .progress {
        margin-bottom: 30px;
    }
    .form-section-title {
        background-color: #f2f2f2;
        padding: 10px;
        margin-top: 20px;
        margin-bottom: 20px;
        border-left: 5px solid #007bff;
    }
    .btn-wrapper {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
    }
</style>

<div id="ziada-reg-form">
    <!-- Progress Bar -->
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Step 1 of 5</div>
    </div>

    <form id="multi-step-form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST">
        <input type="hidden" name="action" value="ziada_form_submit">
        <?php wp_nonce_field( 'ziada_form_submit_nonce', 'ziada_nonce' ); ?>

        <!-- Step 1: Account Type & 1st Investor Info -->
        <div class="form-step active" data-step="1">
            <h4 class="form-section-title">Aina ya Akaunti (Account Type)</h4>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="account_type" id="acc_individual" value="individual" checked>
                    <label class="form-check-label" for="acc_individual">Binafsi (Individual)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="account_type" id="acc_joint" value="joint">
                    <label class="form-check-label" for="acc_joint">Akaunti ya Pamoja (Joint)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="account_type" id="acc_company" value="company">
                    <label class="form-check-label" for="acc_company">Kampuni/Taasisi/Kikundi (Company/Institution/Group)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="account_type" id="acc_minor" value="minor">
                    <label class="form-check-label" for="acc_minor">Mtoto (Minor)</label>
                </div>
            </div>

            <h4 class="form-section-title">SEHEMU A: TAARIFA YA MWEKEZAJI WA KWANZA (1ST INVESTOR'S INFORMATION)</h4>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="fname_1">Jina la Kwanza (First Name)</label>
                    <input type="text" class="form-control" id="fname_1" name="fname_1" required>
                    <div class="invalid-feedback">First name is required.</div>
                </div>
                <div class="col-md-4 form-group">
                    <label for="mname_1">Jina la Kati (Middle Name)</label>
                    <input type="text" class="form-control" id="mname_1" name="mname_1">
                </div>
                <div class="col-md-4 form-group">
                    <label for="lname_1">Jina la Ukoo (Surname)</label>
                    <input type="text" class="form-control" id="lname_1" name="lname_1" required>
                    <div class="invalid-feedback">Last name is required.</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="dob_1">Tarehe ya Kuzaliwa (Date of Birth)</label>
                    <input type="date" class="form-control" id="dob_1" name="dob_1" required>
                    <div class="invalid-feedback">Date of birth is required.</div>
                </div>
                <div class="col-md-4 form-group">
                    <label>Jinsia (Gender)</label>
                    <select class="form-control" name="gender_1" required>
                        <option value="">Please select</option>
                        <option value="male">Mwanaume (Male)</option>
                        <option value="female">Mwanamke (Female)</option>
                    </select>
                    <div class="invalid-feedback">Gender is required.</div>
                </div>
                <div class="col-md-4 form-group">
                    <label for="nationality_1">Uraia (Nationality)</label>
                    <input type="text" class="form-control" id="nationality_1" name="nationality_1" required>
                    <div class="invalid-feedback">Nationality is required.</div>
                </div>
            </div>
            <div class="row">
                 <div class="col-md-6 form-group">
                    <label>Aina ya Kitambulisho (Identification Type)</label>
                    <select class="form-control" name="id_type_1" required>
                        <option value="">Please select</option>
                        <option value="nida">Kitambulisho cha Uraia (NIDA)</option>
                        <option value="passport">Pasipoti (Passport)</option>
                        <option value="drivers_license">Leseni ya Udereva (Driver's License)</option>
                        <option value="election_card">Kadi ya Mpiga Kura (Election Card)</option>
                    </select>
                    <div class="invalid-feedback">Identification type is required.</div>
                </div>
                <div class="col-md-6 form-group">
                    <label for="id_number_1">Namba ya Kitambulisho (Identification Number)</label>
                    <input type="text" class="form-control" id="id_number_1" name="id_number_1" required>
                    <div class="invalid-feedback">Identification number is required.</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="mobile_1">Namba ya Simu (Mobile No)</label>
                    <input type="tel" class="form-control" id="mobile_1" name="mobile_1" required>
                    <div class="invalid-feedback">Mobile number is required.</div>
                </div>
                <div class="col-md-6 form-group">
                    <label for="email_1">Barua Pepe (Email)</label>
                    <input type="email" class="form-control" id="email_1" name="email_1" required>
                    <div class="invalid-feedback">A valid email is required.</div>
                </div>
            </div>

            <div class="btn-wrapper">
                <button type="button" class="btn btn-primary next-step">Next &rarr;</button>
            </div>
        </div>

        <!-- Step 2: Applicant Details (Conditional) -->
        <div class="form-step" data-step="2">
            <!-- Section B: 2nd Investor (for Joint Account) -->
            <div id="section_b_joint" class="conditional-section" style="display: none;">
                <h4 class="form-section-title">SEHEMU B: TAARIFA YA MWEKEZAJI WA PILI (2ND INVESTOR'S INFORMATION)</h4>
                <div class="row">
                    <div class="col-md-4 form-group"><label for="fname_2">Jina la Kwanza (First Name)</label><input type="text" class="form-control" id="fname_2" name="fname_2"></div>
                    <div class="col-md-4 form-group"><label for="mname_2">Jina la Kati (Middle Name)</label><input type="text" class="form-control" id="mname_2" name="mname_2"></div>
                    <div class="col-md-4 form-group"><label for="lname_2">Jina la Ukoo (Surname)</label><input type="text" class="form-control" id="lname_2" name="lname_2"></div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group"><label for="dob_2">Tarehe ya Kuzaliwa</label><input type="date" class="form-control" id="dob_2" name="dob_2"></div>
                    <div class="col-md-4 form-group"><label>Jinsia</label><select class="form-control" name="gender_2"><option value="male">Male</option><option value="female">Female</option></select></div>
                    <div class="col-md-4 form-group"><label for="nationality_2">Uraia</label><input type="text" class="form-control" id="nationality_2" name="nationality_2"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group"><label>Aina ya Kitambulisho</label><select class="form-control" name="id_type_2"><option value="nida">NIDA</option><option value="passport">Passport</option><option value="drivers_license">Driver's License</option><option value="election_card">Election Card</option></select></div>
                    <div class="col-md-6 form-group"><label for="id_number_2">Namba ya Kitambulisho</label><input type="text" class="form-control" id="id_number_2" name="id_number_2"></div>
                </div>
                 <div class="row">
                    <div class="col-md-6 form-group"><label for="mobile_2">Namba ya Simu</label><input type="tel" class="form-control" id="mobile_2" name="mobile_2"></div>
                    <div class="col-md-6 form-group"><label for="email_2">Barua Pepe</label><input type="email" class="form-control" id="email_2" name="email_2"></div>
                </div>
            </div>

            <!-- Section C: Company Info (for Company Account) -->
            <div id="section_c_company" class="conditional-section" style="display: none;">
                 <h4 class="form-section-title">SEHEMU C: TAARIFA YA TAASISI/KAMPUNI/KIKUNDI (COMPANY/INSTITUTION/GROUP INFORMATION)</h4>
                <div class="row">
                    <div class="col-md-6 form-group"><label for="company_name">Jina la Kampuni/Taasisi/Kikundi</label><input type="text" class="form-control" id="company_name" name="company_name"></div>
                    <div class="col-md-6 form-group"><label for="company_reg_no">Namba ya Usajili</label><input type="text" class="form-control" id="company_reg_no" name="company_reg_no"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group"><label for="company_reg_cert">Cheti cha Usajili</label><input type="text" class="form-control" id="company_reg_cert" name="company_reg_cert"></div>
                    <div class="col-md-6 form-group"><label for="company_country">Nchi ya Usajili</label><input type="text" class="form-control" id="company_country" name="company_country"></div>
                </div>
                 <div class="row">
                    <div class="col-md-6 form-group"><label for="company_type">Aina ya Biashara</label><input type="text" class="form-control" id="company_type" name="company_type"></div>
                    <div class="col-md-6 form-group"><label for="company_phone">Namba ya Simu</label><input type="tel" class="form-control" id="company_phone" name="company_phone"></div>
                </div>
                <div class="form-group"><label for="company_email">Barua Pepe</label><input type="email" class="form-control" id="company_email" name="company_email"></div>
            </div>

            <!-- Section D: Guardian Info (for Minor Account) -->
            <div id="section_d_minor" class="conditional-section" style="display: none;">
                <h4 class="form-section-title">SEHEMU D: TAARIFA ZA MZAZI/MLEZI (PARENT/GUARDIAN INFORMATION)</h4>
                <div class="row">
                    <div class="col-md-4 form-group"><label for="guardian_fname">Jina la Kwanza (First Name)</label><input type="text" class="form-control" id="guardian_fname" name="guardian_fname"></div>
                    <div class="col-md-4 form-group"><label for="guardian_mname">Jina la Kati (Middle Name)</label><input type="text" class="form-control" id="guardian_mname" name="guardian_mname"></div>
                    <div class="col-md-4 form-group"><label for="guardian_lname">Jina la Ukoo (Surname)</label><input type="text" class="form-control" id="guardian_lname" name="guardian_lname"></div>
                </div>
            </div>

            <div class="btn-wrapper">
                <button type="button" class="btn btn-secondary prev-step">&larr; Previous</button>
                <button type="button" class="btn btn-primary next-step">Next &rarr;</button>
            </div>
        </div>

        <!-- Step 3: Contact & Bank Details -->
        <div class="form-step" data-step="3">
             <h4 class="form-section-title">SEHEMU E: TAARIFA ZA MAWASILIANO (CONTACT INFORMATION)</h4>
             <div class="row">
                <div class="col-md-6 form-group"><label for="postal_address">Sanduku la Posta</label><input type="text" class="form-control" id="postal_address" name="postal_address"></div>
                <div class="col-md-6 form-group"><label for="physical_address">Anuani ya Makazi</label><input type="text" class="form-control" id="physical_address" name="physical_address"></div>
             </div>
             <div class="row">
                <div class="col-md-3 form-group"><label for="house_no">Namba ya Nyumba</label><input type="text" class="form-control" id="house_no" name="house_no"></div>
                <div class="col-md-3 form-group"><label for="district">Wilaya</label><input type="text" class="form-control" id="district" name="district"></div>
                <div class="col-md-3 form-group"><label for="region">Mkoa</label><input type="text" class="form-control" id="region" name="region"></div>
                <div class="col-md-3 form-group"><label for="country">Nchi</label><input type="text" class="form-control" id="country" name="country"></div>
             </div>

             <h4 class="form-section-title">SEHEMU F: TAARIFA ZA KIBENKI ZA MWEKEZAJI (INVESTOR'S BANK DETAILS)</h4>
             <div class="row">
                <div class="col-md-6 form-group"><label for="bank_name">Jina la Benki</label><input type="text" class="form-control" id="bank_name" name="bank_name"></div>
                <div class="col-md-6 form-group"><label for="bank_branch">Tawi la Benki</label><input type="text" class="form-control" id="bank_branch" name="bank_branch"></div>
             </div>
             <div class="row">
                <div class="col-md-6 form-group"><label for="bank_acc_name">Jina la Akaunti</label><input type="text" class="form-control" id="bank_acc_name" name="bank_acc_name"></div>
                <div class="col-md-6 form-group"><label for="bank_acc_no">Nambari ya Akaunti</label><input type="text" class="form-control" id="bank_acc_no" name="bank_acc_no"></div>
             </div>

            <div class="btn-wrapper">
                <button type="button" class="btn btn-secondary prev-step">&larr; Previous</button>
                <button type="button" class="btn btn-primary next-step">Next &rarr;</button>
            </div>
        </div>

        <!-- Step 4: Financials & Nominees -->
        <div class="form-step" data-step="4">
            <h4 class="form-section-title">SEHEMU G: CHANZO CHA KIPATO (SOURCE OF INCOME)</h4>
            <div class="form-group">
                <div class="form-check"><input class="form-check-input" type="checkbox" name="income_source[]" value="salary"><label class="form-check-label">Mshahara (Salary)</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="income_source[]" value="business"><label class="form-check-label">Biashara (Business)</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="income_source[]" value="others"><label class="form-check-label">Vyanzo Vinginevyo (Others)</label></div>
            </div>
            <div class="form-group">
                <label for="income_others_specify">Please Specify if You have Chosen Others</label>
                <input type="text" class="form-control" id="income_others_specify" name="income_others_specify">
            </div>

            <h4 class="form-section-title">SEHEMU H: TAARIFA ZA WARITHI (DETAILS OF NOMINEES)</h4>
            <div id="nominees-wrapper">
                <!-- Nominee 1 -->
                <div class="nominee-group">
                    <h5>Nominee 1</h5>
                    <div class="row">
                        <div class="col-md-4 form-group"><label>Jina Kamili</label><input type="text" name="nominee_name[]" class="form-control"></div>
                        <div class="col-md-3 form-group"><label>Tarehe ya Kuzaliwa</label><input type="date" name="nominee_dob[]" class="form-control"></div>
                        <div class="col-md-2 form-group"><label>Asilimia ya Umiliki (%)</label><input type="number" name="nominee_ownership[]" class="form-control"></div>
                        <div class="col-md-3 form-group"><label>Uhusiano</label><input type="text" name="nominee_relation[]" class="form-control"></div>
                    </div>
                </div>
            </div>
            <button type="button" id="add-nominee" class="btn btn-info btn-sm">Add Another Nominee</button>

            <h4 class="form-section-title mt-4">TAARIFA ZA MLEZI WA WARITHI (GUARDIAN CONTACT INFORMATION FOR NOMINEES)</h4>
             <div class="row">
                <div class="col-md-6 form-group"><label for="nominee_guardian_name">Jina Kamili</label><input type="text" class="form-control" id="nominee_guardian_name" name="nominee_guardian_name"></div>
                <div class="col-md-6 form-group"><label for="nominee_guardian_dob">Tarehe ya Kuzaliwa</label><input type="date" class="form-control" id="nominee_guardian_dob" name="nominee_guardian_dob"></div>
             </div>
              <div class="row">
                <div class="col-md-6 form-group"><label for="nominee_guardian_address">Anuani ya Makazi</label><input type="text" class="form-control" id="nominee_guardian_address" name="nominee_guardian_address"></div>
                <div class="col-md-6 form-group"><label for="nominee_guardian_phone">Namba ya Simu</label><input type="tel" class="form-control" id="nominee_guardian_phone" name="nominee_guardian_phone"></div>
             </div>

            <div class="btn-wrapper">
                <button type="button" class="btn btn-secondary prev-step">&larr; Previous</button>
                <button type="button" class="btn btn-primary next-step">Next &rarr;</button>
            </div>
        </div>

        <!-- Step 5: Payment & Declaration -->
        <div class="form-step" data-step="5">
            <h4 class="form-section-title">SEHEMU J: TAARIFA ZA MALIPO (PAYMENT DETAILS)</h4>
            <div class="row">
                <div class="col-md-6 form-group"><label for="payment_amount_figures">Kiasi Kilicholipwa kwa Tarakimu Tzs</label><input type="number" class="form-control" id="payment_amount_figures" name="payment_amount_figures"></div>
                <div class="col-md-6 form-group"><label for="payment_amount_words">Kiasi Kilicholipwa kwa Maneno Tzs</label><input type="text" class="form-control" id="payment_amount_words" name="payment_amount_words"></div>
            </div>
             <div class="form-group"><label for="payment_units">Idadi ya Vipande Vilivyonunuliwa</label><input type="number" class="form-control" id="payment_units" name="payment_units"></div>

            <h4 class="form-section-title">SEHEMU K: TAMKO LA UTHIBITISHO (DECLARATION)</h4>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="declaration" name="declaration" required>
                <label class="form-check-label" for="declaration">I/We confirm that the information provided herein is true, complete and accurate...</label>
            </div>

            <div class="btn-wrapper">
                <button type="button" class="btn btn-secondary prev-step">&larr; Previous</button>
                <button type="submit" class="btn btn-success">Submit Application</button>
            </div>
        </div>
    </form>
</div>

<!-- Scripts are enqueued via wp_enqueue_script() -->
