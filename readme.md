# Ziada - Multi-Step Registration Form

A comprehensive WordPress plugin that provides a multi-step registration form for Ziada, complete with an admin interface for managing submissions.

## Description

This plugin creates a complete registration system for Ziada, featuring a user-friendly, multi-step frontend form and a powerful backend interface for administrators. It is designed to be robust, secure, and easy to use.

## Features

### User-Facing Form
*   **Multi-Step Form:** An enhanced user interface with a progress bar and animated transitions.
*   **Language Support:** Form labels can be switched between English and Swahili from a settings page.
*   **Conditional Logic:** The form intelligently displays fields based on the selected account type.
*   **AJAX Submission:** Smooth, modern form submission without page reloads.
*   **File Uploads:** Allows users to upload photos for the primary applicant and nominees.
*   **Save Progress:** Automatically saves user input to local storage to prevent data loss.
*   **Validation:** Client-side validation to guide users before submission.
*   **Responsive Design:** Styled with Bootstrap for a great look on all devices.
*   **Anti-Spam:** Includes a honeypot field to protect against bot submissions.

### Admin & Data Management
*   **Admin Interface:** A dedicated "Ziada" menu in the WordPress admin area.
*   **Submission Management:** View full details for each submission, including uploaded photos.
*   **Search & Filter:** Easily search for submissions and filter by account type.
*   **Delete & Bulk Delete:** Securely delete single or multiple submissions.
*   **Export to CSV:** Export all submission data to a CSV file with a single click.
*   **Print / Save as PDF:** Generate a clean, print-friendly version of a single submission.
*   **Email Notifications:** Automated email notifications for both administrators and users.
*   **Performance:** Scripts and styles are loaded conditionally only on pages where the form is present.
*   **Settings Page:** A page to configure plugin settings, such as the form language.

## Installation

1.  Upload the `ziada-registration-form` directory to the `/wp-content/plugins/` directory.
2.  Activate the plugin through the 'Plugins' menu in WordPress.
3.  Navigate to the "Ziada" > "Settings" page to choose your desired language.

## Usage

To display the registration form, add the following shortcode to the content editor of any page or post:
`[ziada_registration_form]`

Submissions can be managed from the "Ziada" > "Submissions" menu in the admin dashboard.