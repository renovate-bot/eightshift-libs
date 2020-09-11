<?php
/**
 * Class that registers WPCLI command for LintPhpCli.
 *
 * @package EightshiftLibs\LintPhp
 */

declare( strict_types=1 );

namespace EightshiftLibs\LintPhp;

use EightshiftLibs\Cli\AbstractCli;

/**
 * Class LintPhpCli
 */
class LintPhpCli extends AbstractCli {

  /**
   * Output dir relative path.
   */
  const OUTPUT_DIR = 'bin';

  /**
   * Get WPCLI command name
   *
   * @return string
   */
  public function get_command_name() : string {
    return 'run_lint_php';
  }

  /**
   * Get WPCLI command doc.
   *
   * @return string
   */
  public function get_doc() : array {
    return [
      'shortdesc' => 'Initialize Command for linting all you PHP files in the project before you commit to version control.',
    ];
  }

  public function __invoke( array $args, array $assoc_args ) { // phpcs:ignore Squiz.Commenting.FunctionComment.Missing, Generic.CodeAnalysis.UnusedFunctionParameter.FoundInExtendedClassBeforeLastUsed
    $output = shell_exec( 'composer run standards:check' );
    \WP_CLI::log( $output ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.system_calls_shell_exec

    if ( $output !== 0 ) {
      // error occurred
      var_dump('error');
    }else{
      var_dump('success');
        // success
    }
  }
}
