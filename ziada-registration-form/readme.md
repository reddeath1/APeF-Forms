# Ziada - Multi-Step Registration Form

A comprehensive WordPress plugin that provides a multi-step registration form for Ziada, complete with an admin interface for managing submissions.

## Features

### User-Facing Form
*   **Multi-Step Form:** A user-friendly, multi-step registration form with a progress bar and animated transitions.
*   **Conditional Logic:** The form intelligently shows or hides fields based on the selected account type.
*   **AJAX Submission:** Smooth form submission without page reloads.
*   **Save Progress:** Automatically saves user input to local storage, allowing them to resume later.
*   **File Uploads:** Allows users to upload photos for the primary applicant and nominees.
*   **Responsive Design:** Styled with Bootstrap for a clean look on all devices.
*   **Anti-Spam:** Includes a honeypot field to protect against bot submissions.

### Admin & Data Management
*   **Admin Interface:** A dedicated "Ziada" menu in the WordPress admin area.
*   **Submission Management:** View full details for each submission, including uploaded photos.
*   **Search & Filter:** Easily search for submissions and filter by account type.
*   **Delete & Bulk Delete:** Securely delete single or multiple submissions.
*   **Export to CSV:** Export all submission data to a CSV file.
*   **Print / Save as PDF:** Generate a print-friendly version of a single submission.
*   **Email Notifications:** Automated email notifications for admins and users.
*   **Performance:** Scripts and styles are loaded conditionally only on pages where the form is present.

### General
*   **Shortcode:** Easily embed the form using `[ziada_registration_form]`.
*   **About Page:** An 'About' page with plugin usage instructions and company details.

## Installation

1.  Upload the `ziada-registration-form` directory to the `/wp-content/plugins/` directory.
2.  Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

To display the registration form, add the `[ziada_registration_form]` shortcode to any page or post. Submissions can be managed from the "Ziada" menu in the admin dashboard.