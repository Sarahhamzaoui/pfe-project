const express = require("express");
const app = express();

app.get("/", (req, res) => {
  res.send("Backend is working 🚀");
});
app.get("/users", (req, res) => {
  res.json([
    { id: 1, name: "Lea" },
    { id: 2, name: "Sara" }
  ]);
});


app.listen(3000, () => {
  console.log("Server running on port 3000");
});
