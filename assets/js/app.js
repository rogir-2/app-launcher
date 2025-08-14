// DOM elements
const appGrid = document.getElementById('grid');
const liveRegion = document.getElementById('live');
const searchField = document.getElementById('searchInput');
const themeToggleBtn = document.getElementById('themeBtn');
const themeToggleIcon = document.getElementById('themeIcon');

let lastLiveMessage = '';

// Screen reader announcement
function announce(message) {
    if (message && message !== lastLiveMessage) {
        lastLiveMessage = message;
        liveRegion.textContent = '';
        setTimeout(() => (liveRegion.textContent = message), 50);
    }
}

// Theme handling
function applyTheme(isLightMode) {
    document.body.classList.toggle('light', isLightMode);
    document.body.classList.toggle('dark', !isLightMode);

    themeToggleBtn.setAttribute('aria-pressed', String(!isLightMode));
    themeToggleBtn.setAttribute(
        'aria-label',
        isLightMode ? 'Toggle dark mode' : 'Toggle light mode'
    );
    themeToggleIcon.textContent = isLightMode ? '🌙' : '☀️';

    localStorage.setItem('theme', isLightMode ? 'light' : 'dark');
    announce(isLightMode ? 'Light mode on' : 'Dark mode on');
}

// Toggle theme on click
themeToggleBtn.addEventListener('click', () => {
    applyTheme(document.body.classList.contains('dark'));
});

// Load saved theme
applyTheme(localStorage.getItem('theme') === 'light');

// Search functionality - match from the start of name/description
searchField.addEventListener('input', () => {
    const searchQuery = searchField.value.toLowerCase().trim();
    let matchingAppCount = 0;

    appGrid.querySelectorAll('.app-btn').forEach(appButton => {
        const appName = appButton.querySelector('.app-name')?.textContent.toLowerCase() || '';
        const appDesc = appButton.querySelector('.app-description')?.textContent.toLowerCase() || '';

        const matches =
            searchQuery && (appName.startsWith(searchQuery) || appDesc.startsWith(searchQuery));

        appButton.style.display = matches || searchQuery === '' ? 'flex' : 'none';
        if (matches) matchingAppCount++;
    });

    // Remove old "no results" messages
    appGrid.querySelectorAll('.no-results').forEach(el => el.remove());

    // Show "no results" message if needed
    if (matchingAppCount === 0 && searchQuery) {
        const noResultsMsg = document.createElement('div');
        noResultsMsg.className = 'no-results';
        noResultsMsg.textContent = 'No apps found.';
        appGrid.appendChild(noResultsMsg);
        announce('No matching apps found.');
    } else if (searchQuery) {
        announce(`${matchingAppCount} app${matchingAppCount > 1 ? 's' : ''} found`);
    }
});

// Keyboard navigation
document.addEventListener('keydown', (event) => {
    // Skip if typing in form field
    if (['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName) || document.activeElement.isContentEditable) {
        return;
    }

    const visibleAppButtons = Array.from(appGrid.querySelectorAll('.app-btn'))
        .filter(button => button.style.display !== 'none');
    const focusedIndex = visibleAppButtons.indexOf(document.activeElement);

    const columnCount = visibleAppButtons.length > 0
        ? Math.max(1, Math.round(appGrid.offsetWidth / visibleAppButtons[0].offsetWidth))
        : 1;

    // Arrow navigation
    if (event.key === 'ArrowRight' && focusedIndex !== -1) {
        event.preventDefault();
        visibleAppButtons[(focusedIndex + 1) % visibleAppButtons.length].focus();
    }
    if (event.key === 'ArrowLeft' && focusedIndex !== -1) {
        event.preventDefault();
        visibleAppButtons[(focusedIndex - 1 + visibleAppButtons.length) % visibleAppButtons.length].focus();
    }
    if (event.key === 'ArrowDown' && focusedIndex !== -1) {
        event.preventDefault();
        visibleAppButtons[(focusedIndex + columnCount) % visibleAppButtons.length].focus();
    }
    if (event.key === 'ArrowUp' && focusedIndex !== -1) {
        event.preventDefault();
        visibleAppButtons[(focusedIndex - columnCount + visibleAppButtons.length) % visibleAppButtons.length].focus();
    }

    // Open app on Enter or Space
    if ((event.key === ' ' || event.key === 'Enter') &&
        document.activeElement.classList.contains('app-btn')) {
        event.preventDefault();
        const targetLink = document.activeElement.getAttribute('href');
        announce(`Opening ${document.activeElement.querySelector('.app-name').textContent.trim()}`);
        setTimeout(() => (window.location = targetLink), 150);
    }

    // Shortcuts - Control / Command + key
    if (event.ctrlKey || event.metaKey) {
        const pressedKey = event.key.toLowerCase();

        // Focus app with matching shortcut
        const matchingButton = visibleAppButtons.find(btn => {
            const shortcut = btn.dataset.shortcut?.toLowerCase();
            return shortcut === pressedKey;
        });

        if (matchingButton) {
            event.preventDefault();
            matchingButton.focus();
            announce(`Focused ${matchingButton.querySelector('.app-name').textContent.trim()}. Press Enter or Space to open.`);
        }

        // Ctrl/Command + / focuses search
        if (pressedKey === '/') {
            event.preventDefault();
            searchField.focus();
            announce('Search box focused. Type to search.');
        }
    }
});