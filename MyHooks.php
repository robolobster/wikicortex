<?php
/**
 *
 * @file
 * @ingroup Cortex
 */

/**
 * Background job to create a new page, for use by the 'CreateClass' special
 * page.
 *
 * @author Yaron Koren, PiRSquared17
 * @ingroup Cortex
 */
class CortexCreatePageJob extends Job {

	function __construct( $title, $params = '', $id = 0 ) {
		parent::__construct( 'createPage', $title, $params, $id );
	}

	/**
	 * Run a createPage job
	 * @return boolean success
	 */
	function run() {
		wfProfileIn( __METHOD__ );

		if ( is_null( $this->title ) ) {
			$this->error = "createPage: Invalid title";
			wfProfileOut( __METHOD__ );
			return false;
		}
		$article = new Article( $this->title, 0 );
		if ( !$article ) {
			$this->error = 'createPage: Article not found "' . $this->title->getPrefixedDBkey() . '"';
			wfProfileOut( __METHOD__ );
			return false;
		}

		$page_text = $this->params['page_text'];
		// change global $wgUser variable to the one
		// specified by the job only for the extent of this
		// replacement
		global $wgUser;
		$edit_summary = 'Created page from ' . $this->params['from']; // TODO i18n
		$article->doEdit( $page_text, $edit_summary ); // TODO blocks, abusefilter, etc.
		wfProfileOut( __METHOD__ );
		return true;
	}
}

class MyHooks {

/**
 * Occurs after the save page request has been processed.
 * @see https://www.mediawiki.org/wiki/Manual:Hooks/PageContentSaveComplete
 *
 * @param WikiPage $article
 * @param User $user
 * @param Content $content
 * @param string $summary
 * @param boolean $isMinor
 * @param boolean $isWatch
 * @param $section Deprecated
 * @param integer $flags
 * @param {Revision|null} $revision
 * @param Status $status
 * @param integer $baseRevId
 *
 * @return boolean
 */
public static function onPageContentSaveComplete( $article, $user, $content, $summary,
		$isMinor, $isWatch, $section, $flags, $revision, $status, $baseRevId ) {
	$dbr = wfGetDB( DB_SLAVE );
	$res = $dbr->select(
		'pagelinks',
		array( 'pl_namespace', 'pl_title' ),
		'pl_from = ' . $article->getId(),
		__METHOD__,
		array( 'GROUP BY' => 'CONCAT(pl_namespace,":", pl_title)' )
	);
	$jobs = array();
	$from = $article->getTitle()->getPrefixedText();
	foreach ( $res as $row ) {
		if ($title->exists()) continue;
    $title = Title::makeTitleSafe( $row->pl_namespace, $row->pl_title );
		$jobs[] = new CortexCreatePageJob( $title, array(
			'user_id' => 1,
			'page_text' => '{{Thought}} Automatically created from [[$from]].', // TODO i18n
			'from_title' => $from,
		) );
	}
	Job::batchInsert( $jobs );
	return true;
}
}
