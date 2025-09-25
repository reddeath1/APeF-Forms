<div id="ziada-reg-form-wrapper">
    <div id="ziada-reg-form" class="container card p-4">
        <!-- Progress Bar -->
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Step 1 of 5</div>
        </div>
        <hr>

        <form id="multi-step-form" action="" method="POST" enctype="multipart/form-data">

            <!-- Step 1: Account Type & 1st Investor Info -->
            <div class="form-step active" data-step="1">
                <!-- All fields from previous implementation -->
                <div class="form-group">
                    <label for="primary_user_photo">Passport Size Photo</label>
                    <input type="file" class="form-control-file" id="primary_user_photo" name="primary_user_photo" accept="image/*">
                </div>
                 <div class="btn-wrapper"><button type="button" class="btn btn-primary next-step">Next &rarr;</button></div>
            </div>

            <!-- Other steps with all their fields -->

            <!-- Step 4: Nominees -->
            <div class="form-step" data-step="4">
                <!-- ... -->
                <div id="nominees-wrapper">
                    <div class="nominee-group border p-3 mb-3">
                        <h5>Nominee 1</h5>
                        <!-- All nominee fields -->
                        <div class="form-group">
                            <label>Nominee Photo</label>
                            <input type="file" class="form-control-file" name="nominee_photos[]" accept="image/*">
                        </div>
                    </div>
                </div>
                <button type="button" id="add-nominee" class="btn btn-info btn-sm">Add Another Nominee</button>
                <!-- ... -->
            </div>

            <!-- Final Step with Submit Button -->
            <div class="form-step" data-step="5">
                <!-- ... -->
                <div class="btn-wrapper"><button type="button" class="btn btn-secondary prev-step">&larr; Previous</button><button type="submit" class="btn btn-success">Submit Application</button></div>
            </div>
        </form>
        <div id="form-messages" class="mt-3"></div>
    </div>
</div>