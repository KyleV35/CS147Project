function supports_html5_storage() {
  try {
    return 'localStorage' in window && window['localStorage'] !== null;
  } catch (e) {
    return false;
  }
}

function saveState(userID,last_URL) {
    if (supports_html5_storage()) {
        localStorage["userID"] = userID;
        localStorage["last_URL"] = last_URL;
        return true;
    } else {
        return false;
    }
}

function clearState() {
    if (supports_html5_storage()) {
        localStorage.clear();
        return true;
    } else {
        return false;
    }
}