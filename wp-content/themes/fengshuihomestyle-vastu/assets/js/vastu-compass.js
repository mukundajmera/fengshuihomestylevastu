/**
 * VastuCompass - Gyroscope Sensor Integration
 * 
 * Handles device orientation for Vastu compass functionality.
 * Compatible with iOS 13+ (requestPermission) and Android devices.
 *
 * @package FengShuiHomestyle_Vastu
 */

class VastuCompass {
    constructor() {
        // DOM Elements
        this.modal = document.getElementById('compass-modal');
        this.needle = document.getElementById('compass-needle');
        this.feedback = document.getElementById('zone-feedback');
        this.startBtn = document.getElementById('start-compass-btn');
        this.closeBtn = document.getElementById('close-compass-btn');
        this.statusEl = document.getElementById('compass-status');

        // State
        this.isActive = false;
        this.currentHeading = 0;
        this.animationFrame = null;

        // Vastu Zone Mapping (Degrees to Direction & Element)
        this.vastuZones = [
            { min: 0, max: 22.5, direction: 'North', element: 'Water (Jal)', color: '#3B82F6' },
            { min: 22.5, max: 67.5, direction: 'North-East', element: 'Water/Earth (Ishaan)', color: '#06B6D4' },
            { min: 67.5, max: 112.5, direction: 'East', element: 'Air (Vayu)', color: '#22C55E' },
            { min: 112.5, max: 157.5, direction: 'South-East', element: 'Fire (Agni)', color: '#F97316' },
            { min: 157.5, max: 202.5, direction: 'South', element: 'Fire (Yama)', color: '#EF4444' },
            { min: 202.5, max: 247.5, direction: 'South-West', element: 'Earth (Nairutya)', color: '#A855F7' },
            { min: 247.5, max: 292.5, direction: 'West', element: 'Water (Varuna)', color: '#6366F1' },
            { min: 292.5, max: 337.5, direction: 'North-West', element: 'Air (Vayavya)', color: '#8B5CF6' },
            { min: 337.5, max: 360, direction: 'North', element: 'Water (Jal)', color: '#3B82F6' }
        ];

        this.init();
    }

    /**
     * Initialize compass listeners
     */
    init() {
        if (!this.modal || !this.startBtn) {
            console.warn('VastuCompass: Required DOM elements not found.');
            return;
        }

        // Bind event handlers
        this.startBtn.addEventListener('click', () => this.requestPermission());
        this.closeBtn?.addEventListener('click', () => this.close());

        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isModalOpen()) {
                this.close();
            }
        });

        // Expose open method globally for external triggers
        window.openVastuCompass = () => this.open();
    }

    /**
     * Open the compass modal
     */
    open() {
        if (this.modal) {
            this.modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    }

    /**
     * Close the compass modal
     */
    close() {
        if (this.modal) {
            this.modal.style.display = 'none';
            document.body.style.overflow = '';
            this.stopListening();
        }
    }

    /**
     * Check if modal is open
     */
    isModalOpen() {
        return this.modal && this.modal.style.display !== 'none';
    }

    /**
     * Handle permission request (Critical for iOS 13+)
     */
    async requestPermission() {
        this.showStatus('Requesting sensor access...', 'info');

        try {
            // iOS 13+ requires explicit permission request
            if (typeof DeviceOrientationEvent !== 'undefined' &&
                typeof DeviceOrientationEvent.requestPermission === 'function') {

                const permission = await DeviceOrientationEvent.requestPermission();

                if (permission === 'granted') {
                    this.startListening();
                } else {
                    this.showStatus('Permission denied. Please allow motion access in Settings.', 'error');
                }
            } else {
                // Android and older iOS - start immediately
                this.startListening();
            }
        } catch (error) {
            console.error('VastuCompass: Permission error:', error);
            this.showStatus('Error accessing sensors. Try a different browser.', 'error');
        }
    }

    /**
     * Start listening to device orientation
     */
    startListening() {
        // Check for sensor support
        if (!('DeviceOrientationEvent' in window)) {
            this.showStatus('Device orientation not supported on this device.', 'error');
            return;
        }

        this.isActive = true;
        this.startBtn?.classList.add('hidden');
        this.modal?.classList.add('active');
        this.hideStatus();

        // Bind the orientation handler
        this.handleOrientation = this.handleOrientation.bind(this);
        window.addEventListener('deviceorientation', this.handleOrientation, true);

        this.showStatus('Compass activated! Rotate your device.', 'success');
        setTimeout(() => this.hideStatus(), 2000);
    }

    /**
     * Stop listening to device orientation
     */
    stopListening() {
        this.isActive = false;
        window.removeEventListener('deviceorientation', this.handleOrientation, true);

        if (this.animationFrame) {
            cancelAnimationFrame(this.animationFrame);
        }

        this.startBtn?.classList.remove('hidden');
        this.modal?.classList.remove('active');
    }

    /**
     * Handle device orientation event
     * @param {DeviceOrientationEvent} event 
     */
    handleOrientation(event) {
        if (!this.isActive) return;

        let heading;

        // iOS provides webkitCompassHeading (true north)
        if (event.webkitCompassHeading !== undefined) {
            heading = event.webkitCompassHeading;
        }
        // Android uses alpha (magnetic north, requires adjustment)
        else if (event.alpha !== null) {
            // Alpha is the compass direction the device faces
            // When alpha = 0, device points to magnetic north
            heading = 360 - event.alpha;
        } else {
            return; // No valid heading data
        }

        // Normalize to 0-360
        heading = ((heading % 360) + 360) % 360;

        // Smooth animation using requestAnimationFrame
        this.animationFrame = requestAnimationFrame(() => {
            this.updateCompass(heading);
        });
    }

    /**
     * Update compass needle and feedback
     * @param {number} heading - Degrees from North (0-360)
     */
    updateCompass(heading) {
        this.currentHeading = heading;

        // Rotate needle (needle points to North, so we rotate inversely)
        if (this.needle) {
            this.needle.style.transform = `rotate(${-heading}deg)`;
        }

        // Update zone feedback
        this.updateZoneFeedback(heading);
    }

    /**
     * Map heading to Vastu zone and update UI
     * @param {number} heading 
     */
    updateZoneFeedback(heading) {
        const zone = this.vastuZones.find(z => heading >= z.min && heading < z.max);

        if (zone && this.feedback) {
            const directionEl = this.feedback.querySelector('.feedback-direction');
            const elementEl = this.feedback.querySelector('.feedback-element');

            if (directionEl) {
                directionEl.textContent = zone.direction;
                directionEl.style.color = zone.color;
            }

            if (elementEl) {
                elementEl.textContent = zone.element;
            }
        }
    }

    /**
     * Show status message
     * @param {string} message 
     * @param {string} type - 'info', 'success', 'error'
     */
    showStatus(message, type = 'info') {
        if (this.statusEl) {
            this.statusEl.textContent = message;
            this.statusEl.className = `compass-status ${type}`;
            this.statusEl.style.display = 'block';
        }
    }

    /**
     * Hide status message
     */
    hideStatus() {
        if (this.statusEl) {
            this.statusEl.style.display = 'none';
        }
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.vastuCompass = new VastuCompass();
});
