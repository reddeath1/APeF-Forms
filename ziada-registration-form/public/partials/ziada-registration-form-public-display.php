<div id="ziada-reg-form-wrapper">
    <div id="ziada-reg-form" class="container card p-4">
        <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 0%;">Step 1 of 5</div>
        </div>
        <form id="multi-step-form" method="POST" enctype="multipart/form-data">
            <!-- Honeypot -->
            <p class="honeypot-field"><label for="user_website">Website</label><input type="text" name="user_website" id="user_website" value="" tabindex="-1" autocomplete="off"></p>

            <!-- Step 1: Account Type & 1st Investor -->
            <div class="form-step active" data-step="1">
                <!-- All fields for all steps as per the final design -->
            </div>

            <!-- Final Step -->
            <div class="form-step" data-step="5">
                <!-- ... -->
                <div class="btn-wrapper"><button type="button" class="btn btn-secondary prev-step">Previous</button><button type="submit" class="btn btn-success">Submit Application</button></div>
            </div>
        </form>
        <div id="form-messages" class="mt-3"></div>
    </div>
</div>