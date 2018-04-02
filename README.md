BehatLogger
========================

This is a behat 3 extension to log failed steps into files. Curreltly it supports only CSV format.

Add this to your behat.yml file:

<pre>
formatters:
  csv:
    output_path: %paths.base%/build/csv/behat
  extensions:
    prachi\BehatLogger\BehatLoggerExtension:
        name: csv
        renderer: csv
        file_name: Index
</pre>

The *output* parameter is relative to %paths.base% and, when omitted, will default to that same path.

The *renderer* is the renderer engine and the report format that you want to be generated. Currently it supports only CSV.

The *file_name* is optional. When it is added, the report name will be fixed instead fo generated, and this file will be overwritten with every build.
