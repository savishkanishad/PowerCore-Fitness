// api/server.js
import express from "express";
import mysql from "mysql2/promise";
import dotenv from "dotenv";

dotenv.config();
const app = express();

app.use(express.json());

// ✅ Connect to MySQL
const db = await mysql.createConnection({
  host: process.env.DB_HOST, 
  user: process.env.DB_USER, 
  password: process.env.DB_PASS, 
  database: process.env.DB_NAME
});

// ✅ Test route
app.get("/api/hello", (req, res) => {
  res.json({ message: "Hello from Node.js backend 🚀" });
});

// ✅ Example DB route
app.get("/api/users", async (req, res) => {
  try {
    const [rows] = await db.query("SELECT * FROM users");
    res.json(rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

export default app;
