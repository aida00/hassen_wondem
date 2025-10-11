<?php
namespace Drupal\homepage\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\Markup;

/**
 * Controller for the homepage route.
 */
class HomepageController extends ControllerBase {

  /**
   * Returns a page with a full-screen hero banner and Times New Roman text.
   */
  public function content() {
    $module_path = \Drupal::service('extension.path.resolver')->getPath('module', 'homepage');

    $html = '
      <div class="fixed inset-0 w-screen h-screen overflow-hidden">

        <!-- Hero Image -->
        <img 
          src="/' . $module_path . '/src/Controller/desi.png" 
          alt="Banner" 
          class="absolute inset-0 w-full h-full object-cover" 
        />

        <!-- Black Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>

        <!-- Content Container -->
        <div class="relative z-10 text-center text-white px-4 max-w-6xl mx-auto pt-20 md:pt-32" style="font-family: \'Times New Roman\', Times, serif;">

          <!-- First Line - Headline -->
          <h1 class="text-9xl sm:text-6xl md:text-9xl lg:text-8xl font-bold mb-4 sm:mb-6 md:mb-8" style="margin-bottom: 2rem;">
            WELL COME
          </h1>

          <!-- Second Line -->
          <p class="text-base sm:text-4xl md:text-4xl lg:text-4xl font-bold mb-2 sm:mb-4 md:mb-6" style="margin-bottom: 1.5rem;">
            To Sky Medical Supplies job application form
          </p>

          <!-- Third Line -->
          <p class="text-sm sm:text-xl md:text-xl lg:text-xl mb-4 sm:mb-6 md:mb-8 opacity-90" style="margin-bottom: 3rem;">
            To apply for a job, you must sign up first
          </p>

          <!-- Sign Up Button -->
          <div>
            <a href="/registration" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 sm:py-4 sm:px-10 md:py-4 md:px-10 lg:py-4 lg:px-10 rounded transition transform hover:scale-105 text-sm sm:text-xl md:text-xl lg:text-xl" style="font-family: \'Times New Roman\', Times, serif;">
              Sign Up
            </a>
          </div>

        </div>
      </div>
    ';

    return [
      '#markup' => Markup::create($html),
      '#attached' => [
        'library' => [
          'homepage/tailwind',
        ],
      ],
    ];
  }

}
