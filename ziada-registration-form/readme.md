# Ziada - Multi-Step Registration Form

A comprehensive WordPress plugin that provides a multi-step registration form for Ziada, complete with an admin interface for managing submissions.

## Features

*   **Multi-Step Form:** A user-friendly, multi-step registration form with a progress bar and animated transitions.
*   **Conditional Logic:** The form intelligently shows or hides fields based on the selected account type (Individual, Joint, Company, Minor).
*   **Admin Interface:** A dedicated "Ziada" menu in the WordPress admin area to view all submissions.
*   **Submission Management:** View full details for each submission, and delete single or multiple submissions with a secure, nonced action.
*   **Email Notifications:** Automated email notifications are sent to the site administrator and the user upon successful form submission.
*   **Shortcode:** Easily embed the form on any page or post using the `[ziada_registration_form]` shortcode.
*   **Responsive Design:** Styled with Bootstrap for a clean look on all devices.

## Installation

1.  Upload the `ziada-registration-form` directory to the `/wp-content/plugins/` directory on your WordPress installation.
2.  Activate the plugin through the 'Plugins' menu in WordPress.
3.  Upon activation, the plugin will create a custom database table (`wp_ziada_registrations`) to store submissions.

## Usage

To display the registration form on a page or post, simply add the following shortcode to your content:

`[ziada_registration_form]`

All submissions will then be visible in the "Ziada" menu in your WordPress admin dashboard.