Notes on the NavCMSBundle
===
Users:
The User entity for this bundle has been kept simple:

id
username
password (hashed using password_hash($password, PASSWORD_BCRYPT) )

This user entity is used as Model and as a Interface
for authenticating users from the database. Therefore it
implements  the UserInterface from the Symfony Security Component.
By implementing this, we need to use 3 methodsd from this interface:

- getSalt()
- getRoles()
- eraseCreadentials()
