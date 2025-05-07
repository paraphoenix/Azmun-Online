const express = require("express");
const app = express();

app.get("/", (req, res) => {
  res.sendFile(__dirname + "/tests/index.html");
});

app.use(express.static("tests"));
var bodyParser = require("body-parser");
app.use(bodyParser.json());
app.use(
  bodyParser.urlencoded({
    extended: true,
  })
);

app.post("/", function (req, res) {
  console.log((req.body));
  res.write("200");
});

app.listen(3000);
console.log("listenening on 3000");
