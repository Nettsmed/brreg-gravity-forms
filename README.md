# Brønnøysund + Gravity Forms Autocomplete

WordPress plugin that provides autocomplete functionality for Gravity Forms by fetching company data from Brønnøysund's API.

## Features

- **Autocomplete company search** - Search and select companies from Brønnøysund registry
- **Auto-populate fields** - Automatically fills organization number, street, zip, and city
- **CSS class-based mapping** - Flexible field mapping via CSS classes
- **Admin configuration** - Easy-to-use settings page for customizing CSS classes
- **Make fields uneditable** - Option to lock output fields after population

## Installation

1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure CSS classes in **Settings → Brreg GF Autocomplete**

## Configuration

### 1. Set CSS Classes in Gravity Forms

In your Gravity Forms form editor, add CSS classes to your fields:

- **Company name field**: Add CSS class `bedrift` (or your custom class)
- **Organization number**: Add CSS class `org_nummer`
- **Street address**: Add CSS class `invoice_street`
- **Zip code**: Add CSS class `invoice_zip`
- **City**: Add CSS class `invoice_city`

### 2. Configure in WordPress Admin

Go to **Settings → Brreg GF Autocomplete** and:

- Set the CSS class for your company name (trigger) field
- Set CSS classes for output fields (orgnr, street, zip, city)
- Adjust minimum characters before search (default: 2)
- Enable "Make fields uneditable" to lock output fields

## Default CSS Classes

- Trigger field: `bedrift`
- Organization number: `org_nummer`
- Street: `invoice_street`
- Zip: `invoice_zip`
- City: `invoice_city`

## Requirements

- WordPress 5.0+
- Gravity Forms plugin
- PHP 7.4+

## Author

SimplyLearn / Nettsmeds

