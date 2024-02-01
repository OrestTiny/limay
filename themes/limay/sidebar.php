<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Limay
 */

if (!is_active_sidebar('limay-sidebar')) {
  return;
}
?>

<aside class="limay-sidebar">
  <?php dynamic_sidebar('limay-sidebar'); ?>
</aside>