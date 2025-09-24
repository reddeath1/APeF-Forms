# Ziada - Multi-Step Registration Form

A comprehensive WordPress plugin that provides a multi-step registration form for Ziada, complete with an admin interface for managing submissions.

## Features

### User-Facing Form
*   **Multi-Step Form:** A user-friendly, multi-step registration form with a progress bar and animated transitions.
*   **Conditional Logic:** The form intelligently shows or hides fields based on the selected account type (Individual, Joint, Company, Minor).
*   **AJAX Submission:** Smooth form submission without page reloads.
*   **Save Progress:** Automatically saves user input to local storage, allowing them to resume later.
*   **Responsive Design:** Styled with Bootstrap for a clean look on all devices.
*   **Anti-Spam:** Includes a honeypot field to protect against bot submissions.

### Admin & Data Management
*   **Admin Interface:** A dedicated "Ziada" menu in the WordPress admin area to view all submissions.
*   **Submission Management:** View full details for each submission.
*   **Search & Filter:** Easily search for submissions by name or email, and filter by account type.
*   **Delete & Bulk Delete:** Securely delete single or multiple submissions.
*   **Export to CSV:** Export all submission data to a CSV file with a single click.
*   **Email Notifications:** Automated email notifications are sent to the site administrator and the user upon successful form submission.
*   **Performance:** Scripts and styles are loaded conditionally only on pages where the form is present.

### General
*   **Shortcode:** Easily embed the form on any page or post using the `[ziada_registration_form]` shortcode.
*   **About Page:** An 'About' page in the admin area with details about the plugin author and company.

## Installation

1.  Upload the `ziada-registration-form` directory to the `/wp-content/plugins/` directory on your WordPress installation.
2.  Activate the plugin through the 'Plugins' menu in WordPress.
3.  Upon activation, the plugin will create a custom database table (`wp_ziada_registrations`) to store submissions.

## Usage

To display the registration form on a page or post, simply add the following shortcode to your content:

`[ziada_registration_form]`

All submissions will then be visible in the "Ziada" menu in your WordPress admin dashboard.