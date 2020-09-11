<?php
/**
 * File containing failed to load view class
 *
 * @package EightshiftLibs\Exception
 */

declare( strict_types=1 );

namespace EightshiftLibs\Exception;

/**
 * Class Failed_To_Load_View.
 */
final class FailedToLoadView extends \RuntimeException implements GeneralExceptionInterface {

  /**
   * Create a new instance of the exception if the view file itself created
   * an exception.
   *
   * @param string     $uri       URI of the file that is not accessible or
   *                              not readable.
   * @param \Exception $exception Exception that was thrown by the view file.
   *
   * @return static
   */
  public static function view_exception( $uri, $exception ) {
    $message = sprintf(
      esc_html__( 'Could not load the View URI: %1$s. Reason: %2$s.', 'eightshift-libs' ),
      $uri,
      $exception->getMessage()
    );

    return new static( $message, $exception->getCode(), $exception );
  }
}