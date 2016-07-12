#Altmetric for Joomla!

## Documentation
User documentation is available at https://knowledgearc.gitbooks.io/altmetric.

## Build the project with Phing

You will need phing and composer installed to make these next steps work (installing these PHP programs and using them are not covered here).

Before you run phing you will need to copy the build.properties.example file to build.properties and then edit to match your development environment.

To create installable packages for use with the Joomla! installer:

```phing package```

To deploy changes from your development environment into your web server:

```phing deploy```

You will need a running version of Joomla! to be able to use the deploy target.