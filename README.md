# HTMLSource
Display HTML source for an HTML page for a specific URL.

example.php is the example for using the HTMLSource

A brief summarization of this initial version.

I chose to solve this problem using PHP.  It had a built in DOMDocument class that was quite useful for tabulating the various HTML tags for the source for a given HTML page.  

When it came to choosing and highlighting a specific HTML tag type (ie. all div open and close tags), I chose to simply wrap the chosen HTML open and close tag's with a font HTML tag.  This presented an issue - The source in its non-encoded form was easy enough to pick out the a specific HTML tag type to highlight, but I ran into a problem by choosing to highlight the HTML tag using another HTML tag.  This ended up requiring me to do the highlighting based off the HTML entity encoded version of the HTML tags (ie. wrap based off of regex matches for &amp;lt;div&amp;gt; and &amp;lt;/div&amp;gt; instead of &lt;div&gt; and &lt;/div&gt;). So in the end the highlight action was performed by wrapping a non html encoded font HTML tag around all occurrences of the target HTML encoded HTML tag type.

Overall, I am pleased with its initial version.  It is fairly easy to clone this into any web space and start using this immediately.  And it just works.

Things to improve given more time:

1) Validation against all the applicable HTML tag types.  Throw errors if a someone puts in an invalid HTML tag type.

2) Account and fix corner cases that would highlight more than one HTML tag type at a time (ie.  choosing to highlight the 'li' HTML tag type will highlight both 'li' and 'link' HTML tags).

3) Use some form of caching the initial HTML source grab for a given URL.  So when changing between the HTML tag types to highlight, it won't have to make an HTTP request to get the HTML source when switching which HTML tag type to highlight.

4) A more visually pleasing UI.

5) Use an AJAX request when switching the HTML tag type to highlight.  Would generally provide a better UX as opposed to reloading the page each time.

6) Add additional highlighting of the text inside of the highlighted HTML tags. So if highlighted div tags were dark blue, the text in between the div open and close tags might be a lighter blue color.

7) Look at feasibility of using javascript to perform the HTML tag highlighting, instead of relying on PHP.  Initially tried this with jquery with a wrapping replace text (with regex) function followed by a div hide and show, but it didn't work.  This would remove the need for #3 since highlighting HTML tags would not rely on PHP.

8) Use namespaces and composer to make it easier for other developers (who use namespaces and composer) to integrate this into their app. 
