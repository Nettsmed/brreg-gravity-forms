# Brønnøysund + Gravity Forms Autocomplete

WordPress plugin that provides autocomplete functionality for Gravity Forms by fetching company data from Brønnøysund's API.

## Features

- **Autocomplete company search** - Search and select companies from Brønnøysund registry
- **Auto-populate fields** - Automatically fills organization number, street, zip, city, and email
- **CSS class-based mapping** - Flexible field mapping via CSS classes
- **Admin configuration** - Easy-to-use settings page for customizing CSS classes
- **Per-field uneditable control** - Configure which fields should be locked, with options for locking at page load or after population
- **Bypass mode** - When a controlling field (e.g. "Paying privately?") has a given value, populate *only* the organization number and leave address/email editable for manual entry
- **Conditional-required mode** - Make a field required *only* when a controlling field has a given value, with a live "(required)" indicator on the label

All behavior is driven by CSS classes and the settings page — no per-site code required.

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
- **Invoice email**: Add CSS class `invoice_email`

### 2. Configure in WordPress Admin

Go to **Settings → Brreg GF Autocomplete** and:

- Set the CSS class for your company name (trigger) field
- Set CSS classes for output fields (orgnr, street, zip, city, email)
- Adjust minimum characters before search (default: 2)
- Configure per-field uneditable settings in the Field Settings table:
  - **Make Uneditable**: Lock the field at page load
  - **Uneditable After Population**: Lock the field only after a company is selected (unlocks when cleared)

### 3. Bypass mode (optional)

Use when some users should fill billing fields manually instead of pulling them from Brønnøysund — e.g. a "Paying privately?" toggle.

- **Bypass Field CSS Class** — CSS class of the controlling radio/select/checkbox (e.g. `private_payment`)
- **Bypass Value** — the value that activates bypass (e.g. `Ja`)

When the controlling field matches the bypass value, only the organization number is populated from Brønnøysund; the address and email fields stay editable for manual entry.

### 4. Conditional-required mode (optional)

Use when a field should be required only under a condition — e.g. the org number is required when invoicing a company, but optional when paying privately.

- **Conditional Required: Target Field CSS Class** — the field to require conditionally (e.g. `org_number`). **Set this field to "not required" in Gravity Forms** — this feature enforces it conditionally.
- **Conditional Required: Controlling Field CSS Class** — the field that decides (e.g. `private_payment`)
- **Conditional Required: Trigger Value** — when the controlling field has this value, the target is required (e.g. `Nei`)

Two parts work together: a server-side `gform_field_validation` filter enforces the rule on submit, and a small client-side script shows/hides the Gravity Forms "(required)" indicator on the target label live as the controlling field changes.

> **Why this exists:** Gravity Forms' native conditional logic can only toggle a field's *visibility*, not its `required` flag. To make one always-visible field conditionally required you would otherwise need two stacked fields (one required, one optional) — which also breaks autocomplete, since two fields share the same output CSS class. This feature keeps it to a single field.

## Default CSS Classes

- Trigger field: `bedrift`
- Organization number: `org_nummer`
- Street: `invoice_street`
- Zip: `invoice_zip`
- City: `invoice_city`
- Email: `invoice_email`

## Requirements

- WordPress 5.0+
- Gravity Forms plugin
- PHP 7.4+

## Author

SimplyLearn / Nettsmeds

