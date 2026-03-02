<!-- Colorful Loader -->
<div class="page-loader-imm" id="neonLoader">
    <div class="loader-content" style="text-align: center;">
        <div class="loader-imm" style="
            width: 70px;
            height: 70px;
            border: 4px solid rgba(236, 72, 153, 0.15);
            border-top-color: #ec4899;
            border-right-color: #f59e0b;
            border-bottom-color: #10b981;
            border-left-color: #3b82f6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            box-shadow: 0 0 30px rgba(236, 72, 153, 0.3);
        "></div>
        <div style="
            margin-top: 30px;
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(90deg, #ec4899, #f59e0b, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-transform: uppercase;
            letter-spacing: 6px;
        ">ClassHub</div>
        <div style="
            margin-top: 12px;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.5);
            letter-spacing: 3px;
        ">System Loading...</div>
    </div>
</div>

<style>
@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>

<script>
    // Hide loader when page is fully loaded
    window.addEventListener('load', function() {
        setTimeout(function() {
            document.getElementById('neonLoader').classList.add('hidden');
        }, 1500);
    });

    // Fallback hide after 3 seconds
    setTimeout(function() {
        var loader = document.getElementById('neonLoader');
        if (loader) {
            loader.classList.add('hidden');
        }
    }, 3000);
</script>
