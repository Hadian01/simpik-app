/**
 * SIMPIK - Notification System
 * Auto-refresh notifications every 30 seconds
 */

let notificationRefreshInterval;

// Initialize notification system
$(document).ready(function() {
    // Load notifications immediately
    loadNotifications();
    updateNotificationBadge();
    
    // Setup auto-refresh (every 30 seconds)
    notificationRefreshInterval = setInterval(function() {
        updateNotificationBadge();
    }, 30000); // 30 seconds
    
    // When dropdown opens, load full notification list
    $('#notificationBtn').on('click', function() {
        loadNotifications();
    });
    
    // Mark all as read button
    $('#markAllReadBtn').on('click', function(e) {
        e.preventDefault();
        markAllAsRead();
    });
});

/**
 * Update notification badge count
 */
function updateNotificationBadge() {
    $.ajax({
        url: '/notifications/count',
        method: 'GET',
        success: function(response) {
            const count = response.count || 0;
            const badge = $('#notifBadge');
            
            if (count > 0) {
                badge.text(count > 99 ? '99+' : count);
                badge.show();
            } else {
                badge.hide();
            }
        },
        error: function(xhr) {
            console.error('Failed to fetch notification count:', xhr);
        }
    });
}

/**
 * Load full notification list
 */
function loadNotifications() {
    $.ajax({
        url: '/notifications',
        method: 'GET',
        success: function(response) {
            const notifications = response.notifications || [];
            renderNotifications(notifications);
        },
        error: function(xhr) {
            console.error('Failed to fetch notifications:', xhr);
        }
    });
}

/**
 * Render notifications to dropdown
 */
function renderNotifications(notifications) {
    const container = $('#notificationList');
    
    if (notifications.length === 0) {
        container.html(`
            <div class="text-center py-4 text-muted">
                <i class="bi bi-bell-slash" style="font-size:32px;"></i>
                <p class="small mb-0 mt-2">Tidak ada notifikasi</p>
            </div>
        `);
        return;
    }
    
    let html = '';
    
    notifications.forEach(notif => {
        const isUnread = !notif.is_read;
        const bgClass = isUnread ? 'bg-light' : '';
        const icon = getNotificationIcon(notif.type);
        const timeAgo = formatTimeAgo(notif.created_at);
        
        html += `
            <div class="dropdown-item ${bgClass} py-2 px-3 notification-item" 
                 data-id="${notif.id}" 
                 data-read="${notif.is_read}"
                 style="cursor:pointer; border-bottom:1px solid #eee;">
                <div class="d-flex align-items-start gap-2">
                    <div class="text-${getNotificationColor(notif.type)}" style="font-size:20px;">
                        ${icon}
                    </div>
                    <div class="flex-grow-1" style="min-width:0;">
                        <p class="mb-0 font-weight-${isUnread ? 'bold' : 'normal'} small">
                            ${notif.title}
                        </p>
                        <p class="mb-0 text-muted small" style="font-size:12px;">
                            ${notif.message}
                        </p>
                        <p class="mb-0 text-muted" style="font-size:11px; margin-top:4px;">
                            ${timeAgo}
                        </p>
                    </div>
                    ${isUnread ? '<span class="badge badge-primary badge-pill">Baru</span>' : ''}
                </div>
            </div>
        `;
    });
    
    container.html(html);
    
    // Add click handlers
    $('.notification-item').on('click', function() {
        const id = $(this).data('id');
        const isRead = $(this).data('read');
        
        if (!isRead) {
            markAsRead(id);
        }
    });
}

/**
 * Get icon based on notification type
 */
function getNotificationIcon(type) {
    const icons = {
        'pengajuan_baru': '🔔',
        'pengajuan_approved': '✅',
        'pengajuan_rejected': '❌',
        'produk_baru': '✨',
        'stock_validated': '📦'
    };
    return icons[type] || '📬';
}

/**
 * Get color based on notification type
 */
function getNotificationColor(type) {
    const colors = {
        'pengajuan_baru': 'info',
        'pengajuan_approved': 'success',
        'pengajuan_rejected': 'danger',
        'produk_baru': 'primary',
        'stock_validated': 'warning'
    };
    return colors[type] || 'secondary';
}

/**
 * Format time ago
 */
function formatTimeAgo(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const seconds = Math.floor((now - date) / 1000);
    
    const intervals = {
        tahun: 31536000,
        bulan: 2592000,
        minggu: 604800,
        hari: 86400,
        jam: 3600,
        menit: 60
    };
    
    for (const [unit, secondsInUnit] of Object.entries(intervals)) {
        const interval = Math.floor(seconds / secondsInUnit);
        if (interval >= 1) {
            return `${interval} ${unit} lalu`;
        }
    }
    
    return 'Baru saja';
}

/**
 * Mark single notification as read
 */
function markAsRead(notificationId) {
    $.ajax({
        url: `/notifications/${notificationId}/read`,
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            // Reload notifications and update badge
            loadNotifications();
            updateNotificationBadge();
        },
        error: function(xhr) {
            console.error('Failed to mark notification as read:', xhr);
        }
    });
}

/**
 * Mark all notifications as read
 */
function markAllAsRead() {
    $.ajax({
        url: '/notifications/read-all',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            // Reload notifications and update badge
            loadNotifications();
            updateNotificationBadge();
        },
        error: function(xhr) {
            console.error('Failed to mark all notifications as read:', xhr);
        }
    });
}

// Clean up interval on page unload
$(window).on('beforeunload', function() {
    if (notificationRefreshInterval) {
        clearInterval(notificationRefreshInterval);
    }
});
