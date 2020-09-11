<?php
/**
 * Script used to export database and images to zip.
 *
 * @package EightshiftLibs
 */

declare( strict_types=1 );

/**
 * Exporting database.
 *
 * @param string $project_root_path Root of the project where config is located.
 * @param array  $args              Optional arguments.
 *
 * @return void
 */
function db_export( string $project_root_path, array $args = [] ) {

  // Check if optional parameters exists.
  $skip_db      = $args['skip_db'] ?? false;
  $skip_uploads = $args['skip_uploads'] ?? false;

  // Change execution folder.
  if ( ! is_dir( $project_root_path ) ) {
    \WP_CLI::error( "Folder doesn't exist on this path: {$project_root_path}." );
  }

  chdir( $project_root_path );

  // Define db export file name.
  $db_file_name = 'latest.sql';

  // Define export file name.
  $export_file_name = 'latest_dump.tar.gz';

  // Define path to uploads folder.
  $uploads_folder = 'wp-content/uploads';

  // Remove old export file if it exists.
  if ( file_exists( $export_file_name ) ) {
    unlink( $export_file_name );
  }

  // Execute db export.
  if ( ! $skip_db ) {
    \WP_CLI::runcommand( "db export {$db_file_name}" );
    \WP_CLI::log( "Exported db to {$project_root_path} folder." );

    \WP_CLI::log( '--------------------------------------------------' );
  }

  // Execute compress and export for db and uploads folder.
  $export_files = "{$db_file_name} {$uploads_folder}";

  if ( $skip_db ) {
    $export_files = "{$uploads_folder}";

    if ( ! file_exists( $uploads_folder ) ) {
      $export_files = '';
    }
  }

  if ( $skip_uploads ) {
    $export_files = "{$db_file_name}";
  }

  if ( ! empty( $export_files ) ) {
    \WP_CLI::log( shell_exec( "tar czf {$export_file_name} {$export_files}" ) ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.system_calls_shell_exec
    \WP_CLI::log( 'Compressing folders success.' );
    \WP_CLI::log( '--------------------------------------------------' );
  }

  // Finishing.
  \WP_CLI::success( "Export complete! File {$export_file_name} is located in {$project_root_path} folder." );
  \WP_CLI::log( '--------------------------------------------------' );

  // Remove old db export file if it exists.
  if ( file_exists( $db_file_name ) ) {
    unlink( $db_file_name );
  }

}