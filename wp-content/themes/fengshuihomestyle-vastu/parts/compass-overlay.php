<?php
/**
 * Template Part: Compass Overlay
 * 
 * A full-screen Vastu Compass modal with gyroscope integration
 * for iOS 13+ and Android devices.
 *
 * @package FengShuiHomestyle_Vastu
 */

defined('ABSPATH') || exit;
?>

<!-- Vastu Compass Modal Overlay -->
<div id="compass-modal" class="glass-panel compass-overlay" style="display: none;" role="dialog" aria-modal="true"
    aria-labelledby="compass-title">

    <!-- Top Bar -->
    <div class="compass-header">
        <h2 id="compass-title" class="compass-title">Align Your Phone</h2>
        <button type="button" id="close-compass-btn" class="compass-close" aria-label="Close compass">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    <!-- Compass Dial Container -->
    <div class="compass-container">

        <!-- Static Compass Dial Background -->
        <svg class="compass-dial" viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">
            <!-- Outer Ring -->
            <circle cx="150" cy="150" r="140" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="2" />
            <circle cx="150" cy="150" r="120" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="1" />

            <!-- Degree Markings -->
            <g class="compass-markings" stroke="rgba(255,255,255,0.5)" stroke-width="1">
                <!-- Major Ticks (Every 45°) -->
                <line x1="150" y1="20" x2="150" y2="35" stroke-width="2" />
                <line x1="242" y1="58" x2="232" y2="68" stroke-width="2" transform="rotate(45 150 150)" />
                <line x1="280" y1="150" x2="265" y2="150" stroke-width="2" />
                <line x1="242" y1="242" x2="232" y2="232" stroke-width="2" transform="rotate(-45 150 150)" />
                <line x1="150" y1="280" x2="150" y2="265" stroke-width="2" />
                <line x1="58" y1="242" x2="68" y2="232" stroke-width="2" transform="rotate(45 150 150)" />
                <line x1="20" y1="150" x2="35" y2="150" stroke-width="2" />
                <line x1="58" y1="58" x2="68" y2="68" stroke-width="2" transform="rotate(-45 150 150)" />
            </g>

            <!-- Direction Labels -->
            <g class="compass-labels" fill="rgba(255,255,255,0.9)" font-size="14" font-weight="600"
                text-anchor="middle">
                <text x="150" y="55">N</text>
                <text x="220" y="85">NE</text>
                <text x="250" y="155">E</text>
                <text x="220" y="225">SE</text>
                <text x="150" y="255">S</text>
                <text x="80" y="225">SW</text>
                <text x="50" y="155">W</text>
                <text x="80" y="85">NW</text>
            </g>

            <!-- North Highlight (Red Arc) -->
            <path d="M 130 30 A 120 120 0 0 1 170 30" fill="none" stroke="#EF4444" stroke-width="4"
                stroke-linecap="round" />

            <!-- Center Decoration -->
            <circle cx="150" cy="150" r="8" fill="rgba(255,255,255,0.3)" />
            <circle cx="150" cy="150" r="4" fill="rgba(255,255,255,0.6)" />
        </svg>

        <!-- Rotating Compass Needle -->
        <svg id="compass-needle" class="compass-needle" viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">
            <!-- Needle Body -->
            <g transform="translate(150, 150)">
                <!-- North Pointer (Red) -->
                <polygon points="0,-100 -12,0 0,-15 12,0" fill="#EF4444" />
                <!-- South Pointer (Gray) -->
                <polygon points="0,100 -12,0 0,15 12,0" fill="rgba(255,255,255,0.4)" />
                <!-- Center Circle -->
                <circle cx="0" cy="0" r="10" fill="rgba(255,255,255,0.8)" stroke="#EF4444" stroke-width="2" />
            </g>
        </svg>

    </div>

    <!-- Zone Feedback Display -->
    <div id="zone-feedback" class="compass-feedback">
        <span class="feedback-direction">--</span>
        <span class="feedback-separator">•</span>
        <span class="feedback-element">Awaiting Sensor</span>
    </div>

    <!-- Permission Trigger Button -->
    <button type="button" id="start-compass-btn" class="compass-activate-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
        </svg>
        Tap to Activate Compass
    </button>

    <!-- Error/Status Message -->
    <div id="compass-status" class="compass-status" style="display: none;"></div>

</div>

<style>
    /* ==========================================================================
   COMPASS OVERLAY - Vastu Gyroscope Utility
   ========================================================================== */

    .compass-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 99999;
        background: rgba(15, 23, 42, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        padding: 1.5rem;
        padding-top: env(safe-area-inset-top, 1.5rem);
        padding-bottom: env(safe-area-inset-bottom, 1.5rem);
    }

    /* Header */
    .compass-header {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .compass-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #fff;
        margin: 0;
    }

    .compass-close {
        background: rgba(255, 255, 255, 0.1);
        border: none;
        border-radius: 50%;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .compass-close:hover,
    .compass-close:focus {
        background: rgba(255, 255, 255, 0.2);
    }

    /* Compass Container */
    .compass-container {
        position: relative;
        width: min(80vw, 300px);
        height: min(80vw, 300px);
        flex-shrink: 0;
    }

    .compass-dial {
        width: 100%;
        height: 100%;
    }

    .compass-needle {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transition: transform 0.1s ease-out;
        will-change: transform;
    }

    /* Feedback Display */
    .compass-feedback {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 1rem;
        padding: 1rem 1.5rem;
        text-align: center;
        color: #fff;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .feedback-direction {
        font-weight: 700;
        font-size: 1.25rem;
        color: var(--color-amber-light, #FCD34D);
    }

    .feedback-separator {
        opacity: 0.5;
    }

    .feedback-element {
        color: rgba(255, 255, 255, 0.8);
    }

    /* Activate Button */
    .compass-activate-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--color-amber-light, #FCD34D);
        color: #1E293B;
        font-size: 1rem;
        font-weight: 600;
        padding: 1rem 2rem;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        box-shadow: 0 4px 20px rgba(252, 211, 77, 0.3);
    }

    .compass-activate-btn:hover,
    .compass-activate-btn:focus {
        transform: scale(1.05);
        box-shadow: 0 6px 25px rgba(252, 211, 77, 0.4);
    }

    .compass-activate-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .compass-activate-btn.hidden {
        display: none;
    }

    /* Status Message */
    .compass-status {
        text-align: center;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.9rem;
        color: #fff;
    }

    .compass-status.error {
        background: rgba(239, 68, 68, 0.2);
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .compass-status.success {
        background: rgba(34, 197, 94, 0.2);
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    /* Animation for active state */
    .compass-overlay.active .compass-needle {
        animation: pulse-glow 2s ease-in-out infinite;
    }

    @keyframes pulse-glow {

        0%,
        100% {
            filter: drop-shadow(0 0 8px rgba(239, 68, 68, 0.5));
        }

        50% {
            filter: drop-shadow(0 0 15px rgba(239, 68, 68, 0.8));
        }
    }
</style>