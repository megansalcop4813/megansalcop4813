// firebase.js (The Meal Deal)

// import Firebase core + Auth + Firestore using v12.6.0
import { initializeApp } from "https://www.gstatic.com/firebasejs/12.6.0/firebase-app.js";
import { getAuth } from "https://www.gstatic.com/firebasejs/12.6.0/firebase-auth.js";
import { getFirestore } from "https://www.gstatic.com/firebasejs/12.6.0/firebase-firestore.js";

// my Firebase project config
const firebaseConfig = {
    apiKey: "AIzaSyDDZ5LwKyvHmWX9X1-9NYLP8d-6K95bBTY",
    authDomain: "the-meal-deal.firebaseapp.com",
    projectId: "the-meal-deal",
    storageBucket: "the-meal-deal.firebasestorage.app",
    messagingSenderId: "931664510412",
    appId: "1:931664510412:web:2a870834bf5e100c21f169"
};

// initilize Firebase
const app = initializeApp(firebaseConfig);

// export Auth + Firestore so other pages can use it
export const auth = getAuth(app);
export const db = getFirestore(app);