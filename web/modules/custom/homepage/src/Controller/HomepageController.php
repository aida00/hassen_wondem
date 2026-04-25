<?php

namespace Drupal\homepage\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\Markup;

class HomepageController extends ControllerBase {

  public function content() {
    $module_path = \Drupal::service('extension.path.resolver')->getPath('module', 'homepage');

    $html = '
      <style>
        header, footer { display: none !important; visibility: hidden !important; }
        html, body { margin: 0 !important; padding: 0 !important; height: 100%; overflow-x: hidden; }
        .layout-container, .page-content, .region-content, main, .page, .node, .block {
          margin: 0 !important; padding: 0 !important;
        }
        .homepage-viewport {
          position: fixed;
          inset: 0;
          width: 100vw;
          height: 100vh;
          overflow-y: auto;
          overflow-x: hidden;
          z-index: 10;
          background: #0f172a;
        }
      </style>

      <div class="homepage-viewport" x-data="{ activeTrack: \"all\" }">
        <img
          src="/' . $module_path . '/src/Controller/Sky-Medical-Supplies-Front.webp"
          alt="Sky Medical Supplies storefront"
          class="absolute inset-0 w-full h-full object-cover"
        />
        <div class="absolute inset-0 bg-slate-950/80"></div>

        <main class="relative z-10 px-5 py-10 md:py-14 text-white">
          <section class="max-w-7xl mx-auto">
            <p class="text-cyan-300 uppercase tracking-[0.2em] text-xs font-semibold">Wondem Team</p>
            <h1 class="mt-3 text-4xl md:text-5xl font-extrabold">Sky Medical Supplies Remote Support Team</h1>
            <p class="mt-5 max-w-4xl text-base md:text-lg text-slate-200">
              We are a multidisciplinary team of Drupal engineers, security professionals, AHIMA advocates,
              and delivery leaders working together to build trusted digital systems and improve fair access to
              home medical supplies and equipment.
            </p>
          </section>

          <section class="max-w-7xl mx-auto mt-8 md:mt-10">
            <div class="flex flex-wrap gap-2">
              <button type="button" @click="activeTrack = \"all\"" :class="activeTrack === \"all\" ? \"bg-blue-700 text-white\" : \"bg-white text-slate-700\"" class="px-4 py-2 rounded-full border border-slate-200 text-sm font-semibold transition">All</button>
              <button type="button" @click="activeTrack = \"engineering\"" :class="activeTrack === \"engineering\" ? \"bg-blue-700 text-white\" : \"bg-white text-slate-700\"" class="px-4 py-2 rounded-full border border-slate-200 text-sm font-semibold transition">Engineering</button>
              <button type="button" @click="activeTrack = \"security\"" :class="activeTrack === \"security\" ? \"bg-blue-700 text-white\" : \"bg-white text-slate-700\"" class="px-4 py-2 rounded-full border border-slate-200 text-sm font-semibold transition">Security</button>
              <button type="button" @click="activeTrack = \"advocacy\"" :class="activeTrack === \"advocacy\" ? \"bg-blue-700 text-white\" : \"bg-white text-slate-700\"" class="px-4 py-2 rounded-full border border-slate-200 text-sm font-semibold transition">Advocacy</button>
              <button type="button" @click="activeTrack = \"leadership\"" :class="activeTrack === \"leadership\" ? \"bg-blue-700 text-white\" : \"bg-white text-slate-700\"" class="px-4 py-2 rounded-full border border-slate-200 text-sm font-semibold transition">Leadership</button>
            </div>

            <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
              <article x-show="activeTrack === \"all\" || activeTrack === \"engineering\" || activeTrack === \"leadership\"" class="bg-white/95 rounded-2xl border border-slate-200 shadow-sm p-5 text-slate-900">
                <a href="/themes/custom/wondem/images/profile-hussien.jpg?v=6" target="_blank" rel="noopener" class="block">
                  <img src="/themes/custom/wondem/images/profile-hussien.jpg?v=6" alt="Hussien Hassen" class="w-full aspect-square object-cover rounded-xl">
                </a>
                <h3 class="mt-4 text-lg font-bold"><a href="/themes/custom/wondem/images/profile-hussien.jpg?v=6" target="_blank" rel="noopener" class="hover:text-blue-700 transition">Hussien Hassen</a></h3>
                <p class="text-sm text-blue-700 font-semibold mt-1">Drupal Developer | Team Leader</p>
              </article>

              <article x-show="activeTrack === \"all\" || activeTrack === \"engineering\"" class="bg-white/95 rounded-2xl border border-slate-200 shadow-sm p-5 text-slate-900">
                <div class="w-full aspect-square rounded-xl bg-gradient-to-br from-cyan-600 to-blue-700 flex items-center justify-center text-white text-4xl font-bold">IM</div>
                <h3 class="mt-4 text-lg font-bold">Ishak Mohammed</h3>
                <p class="text-sm text-blue-700 font-semibold mt-1">Drupal Platform Engineer</p>
              </article>

              <article x-show="activeTrack === \"all\" || activeTrack === \"security\"" class="bg-white/95 rounded-2xl border border-slate-200 shadow-sm p-5 text-slate-900">
                <div class="w-full aspect-square rounded-xl bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center text-white text-4xl font-bold">MW</div>
                <h3 class="mt-4 text-lg font-bold">Mikias Worku</h3>
                <p class="text-sm text-blue-700 font-semibold mt-1">Security Professional</p>
              </article>

              <article x-show="activeTrack === \"all\" || activeTrack === \"advocacy\"" class="bg-white/95 rounded-2xl border border-slate-200 shadow-sm p-5 text-slate-900">
                <div class="w-full aspect-square rounded-xl bg-gradient-to-br from-emerald-600 to-teal-700 flex items-center justify-center text-white text-4xl font-bold">ET</div>
                <h3 class="mt-4 text-lg font-bold">Enksilase Teshome</h3>
                <p class="text-sm text-blue-700 font-semibold mt-1">Health Information Advocate</p>
              </article>

              <article x-show="activeTrack === \"all\" || activeTrack === \"advocacy\"" class="bg-white/95 rounded-2xl border border-slate-200 shadow-sm p-5 text-slate-900">
                <div class="w-full aspect-square rounded-xl bg-gradient-to-br from-violet-600 to-purple-700 flex items-center justify-center text-white text-4xl font-bold">AH</div>
                <h3 class="mt-4 text-lg font-bold">Abigale Hunda</h3>
                <p class="text-sm text-blue-700 font-semibold mt-1">AHIMA & Community Outreach</p>
              </article>

              <article x-show="activeTrack === \"all\" || activeTrack === \"security\" || activeTrack === \"leadership\"" class="bg-white/95 rounded-2xl border border-slate-200 shadow-sm p-5 text-slate-900">
                <div class="w-full aspect-square rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white text-4xl font-bold">TB</div>
                <h3 class="mt-4 text-lg font-bold">Tadesse Bekele</h3>
                <p class="text-sm text-blue-700 font-semibold mt-1">Quality & Compliance Lead</p>
              </article>

              <article x-show="activeTrack === \"all\" || activeTrack === \"leadership\"" class="bg-white/95 rounded-2xl border border-slate-200 shadow-sm p-5 text-slate-900">
                <div class="w-full aspect-square rounded-xl bg-gradient-to-br from-rose-600 to-pink-700 flex items-center justify-center text-white text-4xl font-bold">DN</div>
                <h3 class="mt-4 text-lg font-bold">Daniel Nigus</h3>
                <p class="text-sm text-blue-700 font-semibold mt-1">Operations & Team Coordination</p>
              </article>

              <article x-show="activeTrack === \"all\"" class="bg-white/95 rounded-2xl border-2 border-dashed border-slate-300 shadow-sm p-5 flex flex-col text-slate-900">
                <div class="w-full aspect-square rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 text-5xl font-light">+</div>
                <h3 class="mt-4 text-lg font-bold">Join Our Team</h3>
                <p class="text-sm text-slate-600 mt-1">We are open to mission-driven professionals.</p>
                <a href="/application-form" class="mt-4 inline-flex items-center justify-center px-4 py-2 rounded-lg bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800 transition">Apply</a>
              </article>
            </div>
          </section>

          <section class="max-w-7xl mx-auto mt-10 bg-white/95 text-slate-900 rounded-2xl border border-slate-200 p-6 md:p-8">
            <h2 class="text-2xl md:text-3xl font-bold">What We Do</h2>
            <p class="mt-4 text-slate-700 text-base md:text-lg max-w-5xl">
              Our team delivers secure Drupal solutions, improves data quality and compliance workflows,
              and supports ethical AHIMA-aligned practices that strengthen access, trust, and service continuity
              across healthcare and home medical operations.
            </p>
          </section>

          <section class="max-w-7xl mx-auto mt-8 mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-white">Areas We Shine</h2>
            <div class="mt-6 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
              <article class="rounded-2xl overflow-hidden shadow-sm border border-slate-200 bg-white text-slate-900">
                <div class="h-32 bg-gradient-to-br from-blue-600 to-cyan-500"></div>
                <div class="p-4">
                  <h3 class="font-bold">Drupal Delivery</h3>
                  <p class="mt-2 text-sm text-slate-600">Enterprise-ready site builds and maintenance.</p>
                </div>
              </article>
              <article class="rounded-2xl overflow-hidden shadow-sm border border-slate-200 bg-white text-slate-900">
                <div class="h-32 bg-gradient-to-br from-slate-800 to-slate-600"></div>
                <div class="p-4">
                  <h3 class="font-bold">Security Engineering</h3>
                  <p class="mt-2 text-sm text-slate-600">Risk reduction, hardening, and secure workflows.</p>
                </div>
              </article>
              <article class="rounded-2xl overflow-hidden shadow-sm border border-slate-200 bg-white text-slate-900">
                <div class="h-32 bg-gradient-to-br from-emerald-600 to-teal-600"></div>
                <div class="p-4">
                  <h3 class="font-bold">AHIMA Advocacy</h3>
                  <p class="mt-2 text-sm text-slate-600">Trusted health information and responsible data use.</p>
                </div>
              </article>
              <article class="rounded-2xl overflow-hidden shadow-sm border border-slate-200 bg-white text-slate-900">
                <div class="h-32 bg-gradient-to-br from-amber-500 to-orange-600"></div>
                <div class="p-4">
                  <h3 class="font-bold">Team Leadership</h3>
                  <p class="mt-2 text-sm text-slate-600">Cross-functional delivery and mentorship culture.</p>
                </div>
              </article>
            </div>
          </section>
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
