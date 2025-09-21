import express from "express";
import { Pool } from "pg";
import dotenv from "dotenv";
import serverless from "serverless-http";   // 👈 makes Express work on Vercel

dotenv.config();
const app = express();
app.use(express.json());

// ✅ PostgreSQL connection pool
const pool = new Pool({
  host: process.env.DB_HOST,
  port: process.env.DB_PORT || 5432,
  user: process.env.DB_USER,
  password: process.env.DB_PASS,
  database: process.env.DB_NAME,
  ssl: { rejectUnauthorized: false }
});

// ✅ Test route
app.get("/hello", (req, res) => {
  res.json({ message: "Hello from Node.js backend 🚀" });
});

// ✅ Example DB route
app.get("/users", async (req, res) => {
  try {
    const { rows } = await pool.query("SELECT * FROM users");
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
    await pool.query(
      "INSERT INTO users (name, email, password, phone, program) VALUES ($1, $2, $3, $4, $5)",
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
    await pool.query(
      "INSERT INTO contact_messages (name, email, message) VALUES ($1, $2, $3)",
      [name, email, message]
    );
    res.json({ success: true, message: "Contact details submitted successfully." });
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// 👇 Export as serverless function (important for Vercel)
export default serverless(app);
