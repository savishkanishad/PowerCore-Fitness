// api/server.js
import express from "express";
import mysql from "mysql2/promise";
import dotenv from "dotenv";

import serverless from "serverless-http";   // 👈 this makes Express work in Vercel

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
app.get("/api/hello", (req, res) => {
  res.json({ message: "Hello from Node.js backend 🚀" });
});

// ✅ Example DB route
app.get("/api/users", async (req, res) => {
  try {
    const connection = await connectDB();
    const [rows] = await connection.query("SELECT * FROM users");
    res.json(rows);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// 👇 Export as serverless function (important for Vercel)
export const handler = serverless(app);
