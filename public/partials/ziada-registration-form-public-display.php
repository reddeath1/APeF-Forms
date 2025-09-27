<?php
/**
 * The public-facing display of the form.
 */
require_once plugin_dir_path(dirname(__FILE__, 2)) . 'includes/ziada-language-helper.php';
?>
<div id="ziada-reg-form-wrapper">
    <div id="ziada-reg-form" class="container card p-4">
        <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 0%;"></div>
        </div>
        <form id="multi-step-form" method="POST" enctype="multipart/form-data">
            <p class="honeypot-field"><label for="user_website">Website</label><input type="text" name="user_website" id="user_website" value="" tabindex="-1" autocomplete="off"></p>

            <!-- Step 1: Account Type & 1st Investor -->
            <div class="form-step active" data-step="1">
                <h4 class="form-section-title"><?php echo strtoupper(ziada_get_string('account_type')); ?></h4>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="account_type" id="acc_individual" value="individual" checked>
                        <label class="form-check-label" for="acc_individual"><?php echo ziada_get_string('individual'); ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="account_type" id="acc_joint" value="joint">
                        <label class="form-check-label" for="acc_joint"><?php echo ziada_get_string('joint'); ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="account_type" id="acc_company" value="company">
                        <label class="form-check-label" for="acc_company"><?php echo ziada_get_string('company').'/'.ziada_get_string('institution').'/'.ziada_get_string('group'); ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="account_type" id="acc_minor" value="minor">
                        <label class="form-check-label" for="acc_minor"><?php echo ziada_get_string('minor'); ?></label>
                    </div>
                </div>

                <h4 class="form-section-title"><?php echo ziada_get_string('investor_1_info'); ?></h4>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="fname_1"><?php echo ziada_get_string('first_name'); ?></label>
                        <input type="text" class="form-control" id="fname_1" name="fname_1" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('first_name') . ' ' . ziada_get_string('is_required'); ?></div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="mname_1"><?php echo ziada_get_string('middle_name'); ?></label>
                        <input type="text" class="form-control" id="mname_1" name="mname_1">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="lname_1"><?php echo ziada_get_string('last_name'); ?></label>
                        <input type="text" class="form-control" id="lname_1" name="lname_1" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('last_name') . ' ' . ziada_get_string('is_required'); ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="dob_1"><?php echo ziada_get_string('dob'); ?></label>
                        <input type="date" class="form-control" id="dob_1" name="dob_1" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('dob') . ' ' . ziada_get_string('is_required'); ?></div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="gender_1"><?php echo ziada_get_string('gender'); ?></label>
                        <select class="form-control" id="gender_1" name="gender_1" required>
                            <option value=""><?php echo ziada_get_string('please_select'); ?></option>
                            <option value="male"><?php echo ziada_get_string('male'); ?></option>
                            <option value="female"><?php echo ziada_get_string('female'); ?></option>
                        </select>
                        <div class="invalid-feedback"><?php echo ziada_get_string('gender') . ' ' . ziada_get_string('is_required'); ?></div>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="nationality_1"><?php echo ziada_get_string('nationality'); ?></label>
                        <input type="text" class="form-control" id="nationality_1" name="nationality_1" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('nationality') . ' ' . ziada_get_string('is_required'); ?></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="id_type_1"><?php echo ziada_get_string('id_type'); ?></label>
                        <select class="form-control" id="id_type_1" name="id_type_1" required>
                            <option value=""><?php echo ziada_get_string('please_select'); ?></option>
                            <option value="nida"><?php echo ziada_get_string('nida'); ?></option>
                            <option value="passport"><?php echo ziada_get_string('passport'); ?></option>
                            <option value="drivers_license"><?php echo ziada_get_string('drivers_license'); ?></option>
                            <option value="election_card"><?php echo ziada_get_string('election_card'); ?></option>
                        </select>
                        <div class="invalid-feedback"><?php echo ziada_get_string('id_type') . ' ' . ziada_get_string('is_required'); ?></div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="id_number_1"><?php echo ziada_get_string('id_number'); ?></label>
                        <input type="text" class="form-control" id="id_number_1" name="id_number_1" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('id_number') . ' ' . ziada_get_string('is_required'); ?></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="mobile_1"><?php echo ziada_get_string('mobile_no'); ?></label>
                        <input type="tel" class="form-control" id="mobile_1" name="mobile_1" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('mobile_no') . ' ' . ziada_get_string('is_required'); ?></div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email_1"><?php echo ziada_get_string('email'); ?></label>
                        <input type="email" class="form-control" id="email_1" name="email_1" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('email') . ' ' . ziada_get_string('is_required'); ?></div>
                    </div>
                </div>

                <div class="btn-wrapper">
                    <button type="button" disabled class="btn btn-secondary prev-step">&larr; Previous</button>
                    <button type="button" class="btn btn-primary float-right next-step">Next &rarr;</button>
                </div>
            </div>
            <!-- Step 2: Applicant Details (Conditional) -->
            <div class="form-step" data-step="2">

                <!-- Section B: 2nd Investor (for Joint Account) -->
                <h4 class="form-section-title"><?= strtoupper(ziada_get_string('investor_2_info')) ?></h4>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="fname_2"><?= ziada_get_string('first_name') ?></label>
                        <input type="text" class="form-control" id="fname_2" name="fname_2" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="mname_2"><?= ziada_get_string('middle_name') ?></label>
                        <input type="text" class="form-control" id="mname_2" name="mname_2" >
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="lname_2"><?= ziada_get_string('surname') ?></label>
                        <input type="text" class="form-control" id="lname_2" name="lname_2" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="dob_2"><?= ziada_get_string('dob') ?></label>
                        <input type="date" class="form-control" id="dob_2" name="dob_2" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label><?= ziada_get_string('gender') ?></label>
                        <select class="form-control" name="gender_2" required>
                            <option value="male"><?= ziada_get_string('male') ?></option>
                            <option value="female"><?= ziada_get_string('female') ?></option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="nationality_2"><?= ziada_get_string('nationality') ?></label>
                        <input type="text" class="form-control" id="nationality_2" name="nationality_2" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label><?= ziada_get_string('id_type') ?></label>
                        <select class="form-control" name="id_type_2" required>
                            <option value="nida"><?= ziada_get_string('nida') ?></option>
                            <option value="passport"><?= ziada_get_string('passport') ?></option>
                            <option value="drivers_license"><?= ziada_get_string('drivers_license') ?></option>
                            <option value="election_card"><?= ziada_get_string('election_card') ?></option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="id_number_2"><?= ziada_get_string('id_number') ?></label>
                        <input type="text" class="form-control" id="id_number_2" name="id_number_2" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="mobile_2"><?= ziada_get_string('mobile_no') ?></label>
                        <input type="tel" class="form-control" id="mobile_2" name="mobile_2" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email_2"><?= ziada_get_string('email') ?></label>
                        <input type="email" class="form-control" id="email_2" name="email_2" required>
                    </div>
                </div>

                <div class="btn-wrapper">
                    <button type="button" class="btn btn-secondary prev-step">&larr; <?= ziada_get_string('previous') ?></button>
                    <button type="button" class="btn btn-primary next-step float-right"><?= ziada_get_string('next') ?> &rarr;</button>
                </div>
            </div>

            <!-- Step 3: Contact & Bank Details -->
            <div class="form-step" data-step="3">

                <!-- Section C: Company Info (for Company Account) -->
                <h4 class="form-section-title"><?= strtoupper(ziada_get_string('company_info')) ?></h4>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="company_name"><?= ziada_get_string('company_name') ?></label>
                        <input type="text" class="form-control" id="company_name" name="company_name" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="company_reg_no"><?= ziada_get_string('company_reg_no') ?></label>
                        <input type="text" class="form-control" id="company_reg_no" name="company_reg_no" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="company_reg_cert"><?= ziada_get_string('company_reg_cert') ?></label>
                        <input type="text" class="form-control" id="company_reg_cert" name="company_reg_cert" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="company_country"><?= ziada_get_string('company_country') ?></label>
                        <input type="text" class="form-control" id="company_country" name="company_country" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="company_type"><?= ziada_get_string('company_type') ?></label>
                        <input type="text" class="form-control" id="company_type" name="company_type" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="company_phone"><?= ziada_get_string('company_phone_number') ?></label>
                        <input type="tel" class="form-control" id="company_phone" name="mobile_no" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="company_email"><?= ziada_get_string('email') ?></label>
                    <input type="email" class="form-control" id="company_email" name="company_email" required>
                </div>

                <!-- Section D: Guardian Info (for Minor Account) -->
                <h4 class="form-section-title"><?= ziada_get_string('guardian_info') ?></h4>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="guardian_fname"><?= ziada_get_string('first_name') ?></label>
                        <input type="text" class="form-control" id="guardian_fname" name="guardian_fname" required>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="guardian_mname"><?= ziada_get_string('middle_name') ?></label>
                        <input type="text" class="form-control" id="guardian_mname" name="guardian_mname" >
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="guardian_lname"><?= ziada_get_string('last_name') ?></label>
                        <input type="text" class="form-control" id="guardian_lname" name="guardian_lname" required>
                    </div>
                </div>

                <div class="btn-wrapper">
                    <button type="button" class="btn btn-secondary prev-step">&larr; <?= ziada_get_string('previous') ?></button>
                    <button type="button" class="btn btn-primary next-step float-right"><?= ziada_get_string('next') ?> &rarr;</button>
                </div>
            </div>

            <!-- Step 4: Contact & Bank Details -->
            <div class="form-step" data-step="4">
                <h4 class="form-section-title"><?php echo ziada_get_string('contact_info'); ?></h4>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="postal_address"><?php echo ziada_get_string('postal_address'); ?></label>
                        <input type="text" class="form-control" id="postal_address" name="postal_address" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('postal_address') . ' ' . ziada_get_string('is_required'); ?>.</div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="physical_address"><?php echo ziada_get_string('physical_address'); ?></label>
                        <input type="text" class="form-control" id="physical_address" name="physical_address" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('physical_address') . ' ' . ziada_get_string('is_required'); ?>.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="house_no"><?php echo ziada_get_string('house_no'); ?></label>
                        <input type="text" class="form-control" id="house_no" name="house_no" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('house_no') . ' ' . ziada_get_string('is_required'); ?>.</div>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="district"><?php echo ziada_get_string('district'); ?></label>
                        <input type="text" class="form-control" id="district" name="district" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('district') . ' ' . ziada_get_string('is_required'); ?>.</div>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="region"><?php echo ziada_get_string('region'); ?></label>
                        <input type="text" class="form-control" id="region" name="region" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('region') . ' ' . ziada_get_string('is_required'); ?>.</div>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="country"><?php echo ziada_get_string('country'); ?></label>
                        <input type="text" class="form-control" id="country" name="country" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('country') . ' ' . ziada_get_string('is_required'); ?>.</div>
                    </div>
                </div>

                <h4 class="form-section-title"><?php echo ziada_get_string('bank_details'); ?></h4>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="bank_name"><?php echo ziada_get_string('bank_name'); ?></label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('bank_name') . ' ' . ziada_get_string('is_required'); ?>.</div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="bank_branch"><?php echo ziada_get_string('bank_branch'); ?></label>
                        <input type="text" class="form-control" id="bank_branch" name="bank_branch" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('bank_branch') . ' ' . ziada_get_string('is_required'); ?>.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="bank_acc_name"><?php echo ziada_get_string('bank_acc_name'); ?></label>
                        <input type="text" class="form-control" id="bank_acc_name" name="bank_acc_name" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('bank_acc_name') . ' ' . ziada_get_string('is_required'); ?>.</div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="bank_acc_no"><?php echo ziada_get_string('bank_acc_no'); ?></label>
                        <input type="text" class="form-control" id="bank_acc_no" name="bank_acc_no" required>
                        <div class="invalid-feedback"><?php echo ziada_get_string('bank_acc_no') . ' ' . ziada_get_string('is_required'); ?>.</div>
                    </div>
                </div>

                <div class="btn-wrapper">
                    <button type="button" class="btn btn-secondary prev-step">&larr; <?php echo ziada_get_string('prev'); ?></button>
                    <button type="button" class="btn btn-primary next-step float-right"><?php echo ziada_get_string('next'); ?> &rarr;</button>
                </div>
            </div>

            <!-- Step 6: Financials & Nominees -->
            <div class="form-step" data-step="5">
                <h4 class="form-section-title"><?php echo ziada_get_string('income_source'); ?></h4>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="income_source[]" value="salary" >
                        <label class="form-check-label"><?php echo ziada_get_string('salary'); ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="income_source[]" value="business" >
                        <label class="form-check-label"><?php echo ziada_get_string('business'); ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="income_source[]" value="others" >
                        <label class="form-check-label"><?php echo ziada_get_string('others'); ?></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="income_others_specify"><?php echo ziada_get_string('income_others_specify'); ?></label>
                    <input type="text" class="form-control" id="income_others_specify" name="income_others_specify" >
                    <div class="invalid-feedback"><?php echo ziada_get_string('income_others_specify') . ' ' . ziada_get_string('is_required'); ?>.</div>
                </div>

                <h4 class="form-section-title"><?php echo ziada_get_string('nominees'); ?></h4>
                <div id="nominees-wrapper">
                    <!-- Nominee 1 -->
                    <div class="nominee-group">
                        <h5>Nominee 1</h5>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label><?php echo ziada_get_string('nominee_name'); ?></label>
                                <input type="text" name="nominee_name[]" class="form-control" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label><?php echo ziada_get_string('nominee_dob'); ?></label>
                                <input type="date" name="nominee_dob[]" class="form-control" required>
                            </div>
                            <div class="col-md-2 form-group">
                                <label><?php echo ziada_get_string('nominee_ownership'); ?></label>
                                <input type="number" name="nominee_ownership[]" class="form-control" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label><?php echo ziada_get_string('nominee_relation'); ?></label>
                                <input type="text" name="nominee_relation[]" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" id="add-nominee" class="btn btn-info btn-sm"><?php echo ziada_get_string('add_nominee'); ?></button>

                <h4 class="form-section-title mt-4"><?php echo ziada_get_string('guardian_nominee_info'); ?></h4>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="nominee_guardian_name"><?php echo ziada_get_string('nominee_guardian_name'); ?></label>
                        <input type="text" class="form-control" id="nominee_guardian_name" name="nominee_guardian_name" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="nominee_guardian_dob"><?php echo ziada_get_string('nominee_guardian_dob'); ?></label>
                        <input type="date" class="form-control" id="nominee_guardian_dob" name="nominee_guardian_dob" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="nominee_guardian_address"><?php echo ziada_get_string('nominee_guardian_address'); ?></label>
                        <input type="text" class="form-control" id="nominee_guardian_address" name="nominee_guardian_address" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="nominee_guardian_phone"><?php echo ziada_get_string('nominee_guardian_phone'); ?></label>
                        <input type="tel" class="form-control" id="nominee_guardian_phone" name="nominee_guardian_phone" required>
                    </div>
                </div>

                <div class="btn-wrapper">
                    <button type="button" class="btn btn-secondary prev-step">&larr; <?php echo ziada_get_string('prev'); ?></button>
                    <button type="button" class="btn btn-primary next-step float-right"><?php echo ziada_get_string('next'); ?> &rarr;</button>
                </div>
            </div>

            <div class="form-step" data-step="6">
                <h4 class="form-section-title"><?php echo ziada_get_string('declaration'); ?></h4>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="declaration" name="declaration" required>
                    <label class="form-check-label" for="declaration"><?php echo ziada_get_string('declaration_text'); ?></label>
                </div>
                <div class="btn-wrapper">
                    <button type="button" class="btn btn-secondary prev-step"><?php echo ziada_get_string('prev'); ?></button>
                    <button type="submit" class="btn btn-success float-right"><?php echo ziada_get_string('submit'); ?></button>
                </div>
            </div>
        </form>
        <div id="form-messages" class="mt-3"></div>
    </div>
</div>