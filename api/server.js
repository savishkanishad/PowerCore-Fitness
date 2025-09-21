import express from "express";
import mysql from "mysql2/promise";
import dotenv from "dotenv";
import serverless from "serverless-http";   // 👈 makes Express work on Vercel

dotenv.config();
const app = express();
app.use(express.json());

// ✅ Database connection (lazy)
let db;
const connectDB = async () => {
  if (!db) {
    db = await mysql.createConnection({
      host: process.env.DB_HOST,
      user: process.env.DB_USER,
      password: process.env.DB_PASS,
      database: process.env.DB_NAME
    });
  }
  return db;
};

// ✅ Test route
app.get("/hello", (req, res) => {
  res.json({ message: "Hello from Node.js backend 🚀" });
});

// ✅ Example DB route
app.get("/users", async (req, res) => {
  try {
    const connection = await connectDB();
    const [rows] = await connection.query("SELECT * FROM users");
    res.json(rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// ✅ User registration route
app.post("/register", async (req, res) => {
  const { name, email, password, phone, program } = req.body;
  if (!name || !email || !password || !phone || !program) {
    return res.status(400).json({ error: "All fields are required." });
  }
  try {
    const connection = await connectDB();
    await connection.query(
      "INSERT INTO users (name, email, password, phone, program) VALUES (?, ?, ?, ?, ?)",
      [name, email, password, phone, program]
    );
    res.json({ success: true, message: "User registered successfully." });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// ✅ Contact form submission route
app.post("/contact", async (req, res) => {
  const { name, email, message } = req.body;
  if (!name || !email || !message) {
    return res.status(400).json({ error: "All fields are required." });
  }
  try {
    const connection = await connectDB();
    await connection.query(
      "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)",
      [name, email, message]
    );
    res.json({ success: true, message: "Contact details submitted successfully." });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// 👇 Export as serverless function (important for Vercel)
export default serverless(app);
