#!/bin/bash
. .env
EXCLUDE="-x .git/ -x config.php -x .env -x node_modules -x vendor -x .git"
cat << 'EOF'
 ____  _                            _                    _       
/ ___|(_)_ __   ___ _ __ ___  _ __ (_)______ _ _ __   __| | ___  
\___ \| | '_ \ / __| '__/ _ \| '_ \| |_  / _` | '_ \ / _` |/ _ \ 
 ___) | | | | | (__| | | (_) | | | | |/ / (_| | | | | (_| | (_) |
|____/|_|_| |_|\___|_|  \___/|_| |_|_/___\__,_|_| |_|\__,_|\___/ 
                                                                 
__        __   _             _         _____ _____ ____  
\ \      / /__| |__   __   _(_) __ _  |  ___|_   _|  _ \ 
 \ \ /\ / / _ \ '_ \  \ \ / / |/ _` | | |_    | | | |_) |
  \ V  V /  __/ |_) |  \ V /| | (_| | |  _|   | | |  __/ 
   \_/\_/ \___|_.__/    \_/ |_|\__,_| |_|     |_| |_|    
   
EOF

echo "Conectando con $FTP_HOST"
lftp -c "open -u $FTP_USER,$FTP_PASS $FTP_HOST; mirror -v -R $EXCLUDE $FTP_LOCAL $FTP_REMOTE; quit"
echo "Sincronización finalizada"
