import { initializeApp } from "https://www.gstatic.com/firebasejs/10.9.0/firebase-app.js";
import { getAuth, signInWithPopup, GoogleAuthProvider } from "https://www.gstatic.com/firebasejs/10.9.0/firebase-auth.js";

export default async function signInWithGoogle({
    apiKey,
    authDomain,
    projectId,
    storageBucket,
    messagingSenderId,
    appId
}) {
    const app = initializeApp({
        apiKey, 
        authDomain, 
        projectId,
        storageBucket,
        messagingSenderId,
        appId
    });
    const auth = getAuth(app);
    const provider = new GoogleAuthProvider();
    const result = await signInWithPopup(auth, provider);
    const token = await result.user.getIdToken();

    // Enviar token al backend
    const res = await fetch("/api/auth", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ token })
    });

    const data = await res.json();
    if (data.success) {
        window.location.href = "/dashboard";
    }
}
