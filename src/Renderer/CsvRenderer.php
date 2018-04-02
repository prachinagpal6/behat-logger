<?php
/**
 * Behat2 renderer for Behat report
 *
 * @author DaSayan <glennwall@free.fr>
 */

namespace prachi\BehatLogger\Renderer;

class CsvRenderer {

  private $extension = 'csv';

  public function __construct() {

  }

  public function getExtension($renderer) {
    return $this->rendererList[$renderer]->getExtension();;
  }

  /**
   * Renders before an exercice.
   *
   * @param object : BehatHTMLFormatter object
   *
   * @return string  : HTML generated
   */
  public function renderBeforeExercise($obj) {
    return '';
  }

  /**
   * Renders after an exercice.
   *
   * @param object : BehatHTMLFormatter object
   *
   * @return string  : HTML generated
   */
  public function renderAfterExercise($obj) {

    //    $strFeatPassed = count($obj->getPassedFeatures());
    //    $strFeatFailed = count($obj->getFailedFeatures());
    //    $strScePassed = count($obj->getPassedScenarios());
    //    $strSceFailed = count($obj->getFailedScenarios());
    //    $strStepsPassed = count($obj->getPassedSteps());
    //    $strStepsPending = count($obj->getPendingSteps());
    //    $strStepsSkipped = count($obj->getSkippedSteps());
    //    $strStepsFailed = count($obj->getFailedSteps());
    //
    //    $featTotal = (count($obj->getFailedFeatures()) + count($obj->getPassedFeatures()));
    //    $sceTotal = (count($obj->getFailedScenarios()) + count($obj->getPassedScenarios()));
    //    $stepsTotal = (count($obj->getFailedSteps()) + count($obj->getPassedSteps()) + count($obj->getSkippedSteps()) + count($obj->getPendingSteps()));
    //
    //    $print = $featTotal . ',' . $strFeatPassed . ',' . $strFeatFailed . "\n";
    //    $print .= $sceTotal . ',' . $strScePassed . ',' . $strSceFailed . "\n";
    //    $print .= $stepsTotal . ',' . $strStepsPassed . ',' . $strStepsFailed . ',' . $strStepsSkipped . ',' . $strStepsPending . "\n";
    //    $print .= $obj->getTimer() . ',' . $obj->getMemory() . "\n";
    //
    //    return $print;
    return '';
  }


  /**
   * Renders before a suite.
   *
   * @param object : BehatHTMLFormatter object
   *
   * @return string  : HTML generated
   */
  public function renderBeforeSuite($obj) {
    // $print = $obj->getCurrentSuite()->getName();

    return '';
  }

  /**
   * Renders after a suite.
   *
   * @param object : BehatHTMLFormatter object
   *
   * @return string  : HTML generated
   */
  public function renderAfterSuite($obj) {
    return '';
  }

  /**
   * Renders before a feature.
   *
   * @param object : BehatHTMLFormatter object
   *
   * @return string  : HTML generated
   */
  public function renderBeforeFeature($obj) {
    return '';
  }

  /**
   * Renders after a feature.
   *
   * @param object : BehatHTMLFormatter object
   *
   * @return string  : HTML generated
   */
  public function renderAfterFeature($obj) {
    return '';
  }

  /**
   * Renders before a scenario.
   *
   * @param object : BehatHTMLFormatter object
   *
   * @return string  : HTML generated
   */
  public function renderBeforeScenario($obj) {
    return '';
  }

  /**
   * Renders after a scenario.
   *
   * @param object : BehatHTMLFormatter object
   *
   * @return string  : HTML generated
   */
  public function renderAfterScenario($obj) {
    return '';
  }

  /**
   * Renders before an outline.
   *
   * @param object : BehatHTMLFormatter object
   *
   * @return string  : HTML generated
   */
  public function renderBeforeOutline($obj) {
    return '';
  }

  /**
   * Renders after an outline.
   *
   * @param object : BehatHTMLFormatter object
   *
   * @return string  : HTML generated
   */
  public function renderAfterOutline($obj) {
    return '';
  }

  /**
   * Renders before a step.
   *
   * @param object : BehatHTMLFormatter object
   *
   * @return string  : HTML generated
   */
  public function renderBeforeStep($obj) {
    return '';
  }

  /**
   * Renders after a step.
   *
   * @param object : BehatHTMLFormatter object
   *
   * @return string  : HTML generated
   */
  public function renderAfterStep($obj) {
    $steps = $obj->getCurrentScenario()->getSteps();
    $step = end($steps); //needed because of strict standards

    //path displayed only if available (it's not available in undefined steps)
    $strPath = '';
    if ($step->getDefinition() !== NULL) {
      $strPath = $step->getDefinition()->getPath();
    }

    $stepResult = '';
    if ($step->isPassed()) {
      $stepResult = 'passed';
    }
    if ($step->isFailed()) {
      $stepResult = 'failed';
    }
    if ($step->isSkipped()) {
      $stepResult = 'skipped';
    }
    if ($step->isPending()) {
      $stepResult = 'pending';
    }
    $print = [$stepResult, $step->getKeyWord() . $step->getText(), $strPath];

    if (!empty($step->getException())) {
    }
    return $this->strPutCSV($print);
  }


  /**
   * To include CSS
   *
   * @return string  : HTML generated
   */
  public function getCSS() {
    return '';

  }

  /**
   * To include JS
   *
   * @return string  : HTML generated
   */
  public function getJS() {
    return '';
  }

  /**
   * @param $data
   *
   * @return bool|string
   */
  public function strPutCSV($data) {
    # Generate CSV data from array
    $fh = fopen('php://temp', 'rw'); # don't create a file, attempt
    # to use memory instead

    fputcsv($fh, $data);

    rewind($fh);
    $csv = stream_get_contents($fh);
    fclose($fh);

    return $csv;
  }
}
