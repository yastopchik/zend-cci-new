<?php 
namespace DmnAdmin\Options;  

interface PrintOptionsInterface  
{	
	
    /**
     * getRatioParamsForColumn
     *
     * @return array
     */
    public function getRatioParamsForColumn();
    /**
     * getExcelToPrintMainPrintOptions
     *
     * @return array
     */
    public function getExcelToPrintMainPrintOptions();
	/**
	 * getTopMainPrintOptions
	 *
	 * @return array
	 */
	public function getTopMainPrintOptions();
	/**
	 * getTopPrintOptions()
	 *
	 * @return array
	 */
	public function getTopPrintOptions();
	/**
	 * getBottomPrintOptions
	 *
	 * @return array
	 */
	public function getBottomPrintOptions();	
	/**
	 * getContentPrintOptions
	 *
	 * @return array
	 */
	public function getContentPrintOptions();
	/**
	 * getOrgExecutorOptions
	 *
	 * @return array
	 */
	public function getOrgExecutorOptions();
	/**
	 * getCountryOptions
	 *
	 * @return array
	 */
	public function getCountryOptions();
	/**
	 * getPunctuationOptions
	 *
	 * @return array
	 */
	public function getPunctuationPrintOptions();
	/**
	 * setTopMainPrintOptions
	 *
	 * @return array
	 */
	public function setTopMainPrintOptions($topMainPrintOptions);
	/**
	 * setTopPrintOptions()
	 *
	 * @return array
	*/
	public function setTopPrintOptions($topPrintOptions);
	/**
	 * setBottom1PrintOptions
	 *
	 * @return array
	*/
	public function setBottomPrintOptions($bootom1PrintOptions);	
	/**
	 * setContentPrintOptions
	 *
	 * @return array
	*/
	public function setContentPrintOptions($contentPrintOptions);
	/**
	 * setOrgExecutorOptions
	 *
	 * @return array
	*/
	public function setOrgExecutorOptions($orgExecutorOptions);
	/**
	 * setCountryOptions
	 *
	 * @return array
	*/
	public function setCountryOptions($countryOptions);
	/**
	 * setPunctuationOptions
	 *
	 * @return array
	*/
	public function setPunctuationPrintOptions($punctuationPrintOptions);
	/**
	 * get Style By Sign
	 * 
	 * @param $cell
	 * @return array
	 */
	public function getStyleBySign($sign);
	/**
	 * getaSheetPrintOptions
	 *
	 * @return array
	 */
	public function getaSheetPrintOptions();
	
	/**
	 * set sheet options
	 * @param string $aSheetPrintOptions
	 * @return PrintOptions
	 */
	public function setaSheetPrintOptions($aSheetPrintOptions);
	
}
