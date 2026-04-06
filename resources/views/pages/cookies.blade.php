<div id="cookie-banner" class="fixed bottom-0 left-0 right-0 border-t bg-white p-4 shadow-lg flex flex-col md:flex-row items-center justify-between gap-4">
  
  <p class="text-sm text-gray-700">
    We use cookies to improve your experience, analyze traffic, and personalize content. 
    <a href="/cookie-policy" class="text-blue-600 underline">Learn more</a>.
  </p>

  <div class="flex gap-2">
    <button onclick="rejectCookies()" class="px-4 py-2 text-sm border rounded hover:bg-gray-100">
      Reject
    </button>

    <button onclick="acceptCookies()" class="px-4 py-2 text-sm bg-black text-white rounded hover:opacity-80">
      Accept
    </button>
  </div>
</div>

<script>
function acceptCookies() {
  localStorage.setItem("cookies_consent", "accepted");
  document.getElementById("cookie-banner").style.display = "none";
}

function rejectCookies() {
  localStorage.setItem("cookies_consent", "rejected");
  document.getElementById("cookie-banner").style.display = "none";
}

window.onload = function () {
  const consent = localStorage.getItem("cookies_consent");
  if (consent) {
    document.getElementById("cookie-banner").style.display = "none";
  }
};
</script>
