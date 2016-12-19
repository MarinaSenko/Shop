<?php



class Pagination {

	/**
	 *
	 * @var Max count links per page
	 *
	 */
	private $max = 10;

	/**
	 *
	 * @var Key for GET, where store number of page
	 *
	 */
	private $index = 'page';

	/**
	 *
	 * @var Current page
	 *
	 */
	private $current_page;

	/**
	 *
	 * @var total sum of records
	 *
	 */
	private $total;

	/**
	 *
	 * @var limitation
	 *
	 */
	private $limit;

	/**
	 * @param type $total <p>Total amount of records</p>
	 * @param type $currentPage <p>Number of current page</p>
	 * @param type $limit <p>Amount of records per page</p>
	 * @param type $index <p>Key for url</p>
	 */
	public function __construct( $total, $currentPage, $limit, $index ) {
		// Set total amount of records
		$this->total = $total;

		# Set total amount of records per page
		$this->limit = $limit;

		# Set key for url
		$this->index = $index;

		# Set amount of pages
		$this->amount = $this->amount();

		# Set number of current page
		$this->setCurrentPage( $currentPage );
	}

	/**
	 *  For outputing links
	 * @return HTML-code with links of navigation
	 */
	public function get() {
		# For record links
		$links = null;

		# Get limitation for loop
		$limits = $this->limits();

		$html = '<ul class="pagination">';
		# Generate links
		for ( $page = $limits[0]; $page <= $limits[1]; $page ++ ) {
			# If current page is current page, there is not link and add class active
			if ( $page == $this->current_page ) {
				$links .= '<li class="active"><a href="#">' . $page . '</a></li>';
			} else {
				# else generate link
				$links .= $this->generateHtml( $page );
			}
		}

		# if links were made
		if ( ! is_null( $links ) ) {
			# If current page is first
			if ( $this->current_page > 1 ) # Make link "На первую"
			{
				$links = $this->generateHtml( 1, '&lt;' ) . $links;
			}
			# f current page is not first
			if ( $this->current_page < $this->amount ) # Make link "На последнюю"
			{
				$links .= $this->generateHtml( $this->amount, '&gt;' );
			}
		}

		$html .= $links . '</ul>';

		return $html;
	}

	/*
	 * for generating HTML-code link
	 * @param integer $page - number of page
	 * @return
	 */
	private function generateHtml( $page, $text = null ) {
		# If text of link is not specified
		if ( ! $text ) # specify that the text is page number
		{
			$text = $page;
		}

		$currentURI = rtrim( $_SERVER['REQUEST_URI'], '/' ) . '/';
		$currentURI = preg_replace( '~/page-[0-9]+~', '', $currentURI );

		# Generate HTML-code of link
		return
			'<li><a href="' . $currentURI . $this->index . $page . '">' . $text . '</a></li>';
	}

	/*
	 * @return array with start and end
	 */
	private function limits() {

		$left  = $this->current_page - round( $this->max / 2 );
		$start = $left > 0 ? $left : 1;
		if ( $start + $this->max <= $this->amount ) {
			$end = $start > 1 ? $start + $this->max : $this->max;
		} else {
			$end   = $this->amount;
			$start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
		}

		return
			array( $start, $end );
	}

	/*
	 * For setting current page
	 */
	private function setCurrentPage( $currentPage ) {
		# Get current page
		$this->current_page = $currentPage;
		if ( $this->current_page > 0 ) {
			if ( $this->current_page > $this->amount ) {
				$this->current_page = $this->amount;
			}
		} else {
			$this->current_page = 1;
		}
	}

	/*
	 * For getting total amount of pages
	 * @return amount of pages
	 */
	private function amount() {
		return ceil( $this->total / $this->limit );
	}

}
