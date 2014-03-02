wikicortex
==========

A MediaWiki based tool to hierarchically gather your thoughts and knowledge. 

Knowledge is a network, it might be useful to be able to represent as such (using open source software).


These are the intented features, and the possible ways to implement them:

Soon, important
  - Backlinks transcluded into every page - This helps show the context of a thought in the hierarchy of thoughts.
      * Changed the first line of SpecialWhatLinksHere to extend IncludableSpecialPage. Simple!
      * SMW can do backlinks for properties (relations) eg. {{#ask:[[Is parent of::{{PAGENAME}}]]}}
  - Autocomplete links - This makes it easy to create thoughts and connect them quickly.
    See:
      * https://www.mediawiki.org/wiki/Extension:LinkSuggest
      * Visual Editor (is it as problematic as they say?)
      * Semantic Forms also has an autocompletion feature, although not for free text.
      
  - Pages are automatically created once a link is created (red links are automatically populated)
      * Semantic Forms may have a way to do this automatically for Semantic Forms. https://www.mediawiki.org/wiki/Extension:Semantic_Forms/Linking_to_forms#Populating_red-linked_pages_automatically
      * If those Semantic Forms are not ideal, use a hook to call SF_CreatePageJob.php found here https://git.wikimedia.org/blob/mediawiki%2Fextensions%2FSemanticForms.git/8ab4f7aab17510c013ee8becd21f8cbdd918b3aa/includes%2FSF_CreatePageJob.php
      

Not soon, important
  - Automatic wiki backups
