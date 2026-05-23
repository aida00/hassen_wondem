<?php

namespace Drupal\homepage\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\Markup;

class HomepageController extends ControllerBase {

  public function content() {
    $module_path = \Drupal::service('extension.path.resolver')->getPath('module', 'homepage');

    $html = '
      <style>
        header, footer { display:none !important; visibility:hidden !important; }
        html, body { margin:0 !important; padding:0 !important; height:100%; overflow-x:hidden; }
        .layout-container, .page-content, .region-content, main, .page, .node, .block {
          margin:0 !important; padding:0 !important;
        }
        .homepage-viewport {
          position: fixed;
          inset: 0;
          width: 100vw;
          height: 100vh;
          overflow-y: auto;
          overflow-x: hidden;
          z-index: 10;
          background: #000;
        }
      </style>

      <div class="homepage-viewport">
        <img
          src="/' . $module_path . '/src/Controller/desi.png"
          alt="Sky Medical Supplies storefront"
          class="absolute inset-0 w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>

        <main class="relative z-10 flex flex-col items-center justify-center min-h-screen px-4 py-16 md:py-24 text-white">
          <div class="w-full max-w-5xl text-center" style="font-family:\'Times New Roman\', Times, serif;">
            <h1 class="mb-4 md:mb-6 font-bold tracking-wide uppercase text-4xl sm:text-5xl md:text-6xl lg:text-7xl">
              Welcome to
            </h1>

            <p class="mb-6 md:mb-8 font-bold text-xl sm:text-2xl md:text-3xl">
              Sky Medical Supplies Job Application Portal
            </p>

            <p class="mb-6 md:mb-8 text-base sm:text-lg md:text-xl opacity-90">
              Log in or Sign up to apply for a job.
            </p>

            <nav aria-label="Authentication actions"
                class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4 mb-10 md:mb-14">
              <a href="/user/login"
                role="button"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-8 py-3 text-base sm:text-lg font-semibold shadow-md hover:bg-blue-700 hover:shadow-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-white/80 transition"
                aria-label="Log in to your account">
                Log in
              </a>
              <span class="hidden sm:inline opacity-80">or</span>
              <a href="/user/register"
                role="button"
                class="inline-flex items-center justify-center rounded-lg bg-white/10 px-8 py-3 text-base sm:text-lg font-semibold shadow-md hover:bg-white/20 hover:shadow-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-white/80 transition"
                aria-label="Create a new account">
                Sign up
              </a>
            </nav>

            <section aria-labelledby="discover-sms" class="mx-auto w-full max-w-3xl">
              <div class="rounded-xl bg-white/10 backdrop-blur-sm px-5 py-5 md:px-6 md:py-6 shadow-lg">
                <h2 id="discover-sms" class="mb-3 md:mb-4 text-lg md:text-xl font-semibold">
                  Discover Sky Medical Supplies
                </h2>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-center gap-3 sm:gap-4">
                  <a href="https://simplyrenting.com" target="_blank" rel="noopener"
                    class="inline-flex items-center justify-center rounded-lg border border-white/40 bg-white/5 px-6 py-3 text-sm md:text-base font-medium hover:bg-white/15 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/80 transition">
                    Visit website
                  </a>
                  <a href="/wondem-team"
                    class="inline-flex items-center justify-center rounded-lg border border-white/40 bg-white/5 px-6 py-3 text-sm md:text-base font-medium hover:bg-white/15 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/80 transition">
                    View Sky Medical Supplies Team
                  </a>
                </div>
              </div>
            </section>
          </div>
        </main>
      </div>
    ';

    return [
      '#markup' => Markup::create($html),
      '#attached' => [
        'library' => ['homepage/tailwind'],
      ],
    ];
  }
}
