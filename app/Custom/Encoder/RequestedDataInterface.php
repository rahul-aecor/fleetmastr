<?php 
/**
 * @file
 * Requested Data Interface.
 *
 * All LaravelJqGrid code is copyright by the original authors and released under the MIT License.
 * See LICENSE.
 */

namespace App\Custom\Encoder;

use App\Custom\Repositories\RepositoryInterface;

interface RequestedDataInterface {
	
	/**
	 * Echo in a jqGrid compatible format the data requested by a grid.
	 *
	 * @param RepositoryInterface $dataRepository
	 *	An implementation of the RepositoryInterface
	 * @param  array $postedData
	 *	All jqGrid posted data
	 * @return void
	 */
	public function encodeRequestedData(RepositoryInterface $Repository,  $postedData);
	
}

