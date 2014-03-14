wikicortex
==========

A MediaWiki based tool to hierarchically network your thoughts and knowledge. 

Knowledge is a network, it might be useful to be able to represent as such (using open source software).


These are the intented features, and the possible ways to implement them:

Soon, important
  - Backlinks transcluded into every page - This helps show the context of a thought in the hierarchy of thoughts.
      * Implemented: Changed the first line of SpecialWhatLinksHere to extend IncludableSpecialPage. Simple!
      * This has been independently done by someone else here https://gerrit.wikimedia.org/r/#/c/106625/
      * SMW can do backlinks for properties (relations) eg. {{#ask:[[Is parent of::{{PAGENAME}}]]}}
  - Autocomplete links - This makes it easy to create thoughts and connect them quickly.
    See:
      * https://www.mediawiki.org/wiki/Extension:LinkSuggest
      * Implemented: Visual Editor does autocomplete to any existing pages (I have heard Visual Editor is problematic though.)
      * Semantic Forms also has an autocompletion feature, although not for free text.
      
  - Pages are automatically created once a link is created (red links are automatically populated)
      * Semantic Forms may have a way to do this automatically for Semantic Forms. https://www.mediawiki.org/wiki/Extension:Semantic_Forms/Linking_to_forms#Populating_red-linked_pages_automatically
      * If those Semantic Forms are not ideal, use a hook to call SF_CreatePageJob.php found here https://git.wikimedia.org/blob/mediawiki%2Fextensions%2FSemanticForms.git/8ab4f7aab17510c013ee8becd21f8cbdd918b3aa/includes%2FSF_CreatePageJob.php
      * Yaron suggested creating a new function using the code from SF_CreatePageJob.php "you probably need to change the function itself, to look a function that's called by a hook. Another reason to make your own copy of the code, instead of just reusing the SF code."

Not soon, important
  - Automatic wiki backups
  - 

This is a very early prototype. Any bad ideas or poor design is due to Robolobster, anything about this project that is useful and/or virtuous is thanks to Yaron and PiRSsquared17 of MediaWiki.
