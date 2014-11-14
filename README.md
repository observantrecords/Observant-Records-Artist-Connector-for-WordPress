# Observant Records Artist Connector

## Overview

Observant Records Artist Connector connects the Observant Records artist directory with WordPress.

## Installation

Install the plugin directory under ``wp-content/plugins`` or ``wp-content/mu-plugins``.

## Configuration

After installation, go to Settings / Artist Connector and fill in the fields to connect to the Observant Records database.

* **Database host**: The name where the Observant Records database is hosted.
* **Database name**: The name of the Observant Records database on the server.
* **Database user**: The name of a user with credentials to read to the Observant Records database.
* **Database password**: The password of the user.

## Usage

After the plugin has been enabled and a database connnection stored, the Observant Records Artist Connector creates new post types: **Artist**, **Album** and **Track**. Editing posts in each of these new types includes a section for providing Observant Records meta data. Populate these fields with ``*_alias`` fields in the Observant Records database.
