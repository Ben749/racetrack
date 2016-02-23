        /!\ Disclaimer : THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. /!\

Project Homepage && Demo :
- https://racetrack.x24.fr
        
Cookbook / installation :

- cd /home;git clone https://github.com/Ben749/racetrack.git;
  cd racetrack;git branch yourCustomBranchName;
  git fetch origin;git merge origin/master -X ours;#pulling newer code ( keeping your code upon each pull )
 
- replace /home/racetrack/ by your install path within each file if required
- add 127.0.0.1 racetrack.dev host.2 to /WINDOWS/system32/drivers/etc/hosts
- create apache vhost for racetrack.dev && host.2 >>> described in vhosts.conf

Three Methods for Prepending Racetrack :
- add to php.ini : auto_prepend_file /home/racetrack/rt/prepend.php
- FrontController : within racetrack.dev/.htaccess >> uncomment : #RewriteRule .? index.php?frontcontroller=1 [QSA,L]
- .htaccess : php_value auto_prepend_file  /home/racetrack/rt/prepend.php

Racetrack : 
- Powerful user-friendly hybrid php & js toolbox
- Fast Plug & Play
- Aimed at : performance && portability
- Quick website design & publish
- Relays mainly on serialized files when sql not needed + Failsafes
- Built since 2007, used in various project, handles =~97000 daily PV on 2go basic webserver .. 
- Benchmarks : main memory load : 1.6mo .. avg page generation time : 5ms
- Not deprecated && notice proof !!
- Might content old references fro projects back in 2007, as well as comments in French within code    
- Philosophy : 
    Getting the job done ! reduce dependencies, accessible, comprehensive, might used librairies in other projets ( just have to mimic the initial "kernel" definitions ) 
    KISS: keep it simple, stupid
    YAGNI : You ain't gonna need it

    "Don't use fancy OOP features just because you can. Use fancy OOP features because they have specific, demonstrable benefit to the problem you're trying to solve." 


------------------------------------------------------------------
small functions names : e, rem, rep, uses global space, lots of defined constants ( beware how you're handling arrays in php !! )
