
CONTENTS OF THIS FILE
---------------------

 * Requirements
 * Running the app
 * Comments


REQUIREMENTS
------------

This project only dependency is docker.


RUNNING THE APP
---------------

- Download this repository.
- In a terminal, go to the project folder and run 'docker-compose up -d'.
- Visit http://localhost or http://localhost/user-data.


COMMENTS
--------

This repository contains all drupal tree necesary files. It was done only because the complete
application was asked to work on an apache server (so the complete folder can be copied). A deeper
look on the docker compose file shows that not all the tree is necessary. Composer was not used
this time for the same reason.

All mysql DB files are in the db folder. DB credentials can be checked in the dockerfile. These
files were kept for the same reason the drupal tree is complete (easier to copy on a MySQL server),
otherwise a mint DB and config import would have been used.

Data is saved only at the end because requirements say the user is created only in the last step.

Permissions were not created to avoid extra work assigning them. Anyway, the admin user and password
are admin/admin.