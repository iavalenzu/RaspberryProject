#
# Generated Makefile - do not edit!
#
# Edit the Makefile in the project folder instead (../Makefile). Each target
# has a -pre and a -post target defined where you can add customized code.
#
# This makefile implements configuration specific macros and targets.


# Environment
MKDIR=mkdir
CP=cp
GREP=grep
NM=nm
CCADMIN=CCadmin
RANLIB=ranlib
CC=gcc
CCC=g++
CXX=g++
FC=gfortran
AS=as

# Macros
CND_PLATFORM=GNU-MacOSX
CND_DLIB_EXT=dylib
CND_CONF=Debug
CND_DISTDIR=dist
CND_BUILDDIR=build

# Include project Makefile
include Makefile

# Object Directory
OBJECTDIR=${CND_BUILDDIR}/${CND_CONF}/${CND_PLATFORM}

# Object Files
OBJECTFILES= \
	${OBJECTDIR}/_ext/429082616/ActionExecutor.o \
	${OBJECTDIR}/_ext/429082616/ActionPersistentSender.o \
	${OBJECTDIR}/Action.o \
	${OBJECTDIR}/ActionEcho.o \
	${OBJECTDIR}/ActionFactory.o \
	${OBJECTDIR}/ActionGetFortune.o \
	${OBJECTDIR}/ActionPersistentReceiver.o \
	${OBJECTDIR}/ActionReportDelivery.o \
	${OBJECTDIR}/ActionResponseTime.o \
	${OBJECTDIR}/ActionUpdateClient.o \
	${OBJECTDIR}/ConnectionSSL.o \
	${OBJECTDIR}/DatabaseAdapter.o \
	${OBJECTDIR}/Device.o \
	${OBJECTDIR}/IncomingAction.o \
	${OBJECTDIR}/IncomingActionExecutor.o \
	${OBJECTDIR}/IncomingActionFactory.o \
	${OBJECTDIR}/Logger.o \
	${OBJECTDIR}/Notification.o \
	${OBJECTDIR}/OutcomingAction.o \
	${OBJECTDIR}/OutcomingActionExecutor.o \
	${OBJECTDIR}/OutcomingActionFactory.o \
	${OBJECTDIR}/RaspiUtils.o \
	${OBJECTDIR}/ServerSSL.o \
	${OBJECTDIR}/libjson/_internal/Source/JSONAllocator.o \
	${OBJECTDIR}/libjson/_internal/Source/JSONChildren.o \
	${OBJECTDIR}/libjson/_internal/Source/JSONDebug.o \
	${OBJECTDIR}/libjson/_internal/Source/JSONIterators.o \
	${OBJECTDIR}/libjson/_internal/Source/JSONMemory.o \
	${OBJECTDIR}/libjson/_internal/Source/JSONNode.o \
	${OBJECTDIR}/libjson/_internal/Source/JSONNode_Mutex.o \
	${OBJECTDIR}/libjson/_internal/Source/JSONPreparse.o \
	${OBJECTDIR}/libjson/_internal/Source/JSONStream.o \
	${OBJECTDIR}/libjson/_internal/Source/JSONValidator.o \
	${OBJECTDIR}/libjson/_internal/Source/JSONWorker.o \
	${OBJECTDIR}/libjson/_internal/Source/JSONWriter.o \
	${OBJECTDIR}/libjson/_internal/Source/internalJSONNode.o \
	${OBJECTDIR}/libjson/_internal/Source/libjson.o \
	${OBJECTDIR}/main.o


# C Compiler Flags
CFLAGS=

# CC Compiler Flags
CCFLAGS=
CXXFLAGS=

# Fortran Compiler Flags
FFLAGS=

# Assembler Flags
ASFLAGS=

# Link Libraries and Options
LDLIBSOPTIONS=/usr/local/lib/libmysqlcppconn.dylib

# Build Targets
.build-conf: ${BUILD_SUBPROJECTS}
	"${MAKE}"  -f nbproject/Makefile-${CND_CONF}.mk ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryserver

${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryserver: /usr/local/lib/libmysqlcppconn.dylib

${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryserver: ${OBJECTFILES}
	${MKDIR} -p ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}
	${LINK.cc} -o ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryserver ${OBJECTFILES} ${LDLIBSOPTIONS} -lssl -lcrypto -lm -lcurl

${OBJECTDIR}/_ext/429082616/ActionExecutor.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/ActionExecutor.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/429082616
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/429082616/ActionExecutor.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/ActionExecutor.cpp

${OBJECTDIR}/_ext/429082616/ActionPersistentSender.o: /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/ActionPersistentSender.cpp 
	${MKDIR} -p ${OBJECTDIR}/_ext/429082616
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/_ext/429082616/ActionPersistentSender.o /Users/Ismael/NetBeansProjects/RaspberryProject/RaspberryServer/ActionPersistentSender.cpp

${OBJECTDIR}/Action.o: Action.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/Action.o Action.cpp

${OBJECTDIR}/ActionEcho.o: ActionEcho.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/ActionEcho.o ActionEcho.cpp

${OBJECTDIR}/ActionFactory.o: ActionFactory.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/ActionFactory.o ActionFactory.cpp

${OBJECTDIR}/ActionGetFortune.o: ActionGetFortune.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/ActionGetFortune.o ActionGetFortune.cpp

${OBJECTDIR}/ActionPersistentReceiver.o: ActionPersistentReceiver.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/ActionPersistentReceiver.o ActionPersistentReceiver.cpp

${OBJECTDIR}/ActionReportDelivery.o: ActionReportDelivery.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/ActionReportDelivery.o ActionReportDelivery.cpp

${OBJECTDIR}/ActionResponseTime.o: ActionResponseTime.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/ActionResponseTime.o ActionResponseTime.cpp

${OBJECTDIR}/ActionUpdateClient.o: ActionUpdateClient.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/ActionUpdateClient.o ActionUpdateClient.cpp

${OBJECTDIR}/ConnectionSSL.o: ConnectionSSL.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/ConnectionSSL.o ConnectionSSL.cpp

${OBJECTDIR}/DatabaseAdapter.o: DatabaseAdapter.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/DatabaseAdapter.o DatabaseAdapter.cpp

${OBJECTDIR}/Device.o: Device.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/Device.o Device.cpp

${OBJECTDIR}/IncomingAction.o: IncomingAction.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/IncomingAction.o IncomingAction.cpp

${OBJECTDIR}/IncomingActionExecutor.o: IncomingActionExecutor.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/IncomingActionExecutor.o IncomingActionExecutor.cpp

${OBJECTDIR}/IncomingActionFactory.o: IncomingActionFactory.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/IncomingActionFactory.o IncomingActionFactory.cpp

${OBJECTDIR}/Logger.o: Logger.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/Logger.o Logger.cpp

${OBJECTDIR}/Notification.o: Notification.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/Notification.o Notification.cpp

${OBJECTDIR}/OutcomingAction.o: OutcomingAction.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/OutcomingAction.o OutcomingAction.cpp

${OBJECTDIR}/OutcomingActionExecutor.o: OutcomingActionExecutor.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/OutcomingActionExecutor.o OutcomingActionExecutor.cpp

${OBJECTDIR}/OutcomingActionFactory.o: OutcomingActionFactory.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/OutcomingActionFactory.o OutcomingActionFactory.cpp

${OBJECTDIR}/RaspiUtils.o: RaspiUtils.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/RaspiUtils.o RaspiUtils.cpp

${OBJECTDIR}/ServerSSL.o: ServerSSL.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/ServerSSL.o ServerSSL.cpp

${OBJECTDIR}/libjson/_internal/Source/JSONAllocator.o: libjson/_internal/Source/JSONAllocator.cpp 
	${MKDIR} -p ${OBJECTDIR}/libjson/_internal/Source
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/libjson/_internal/Source/JSONAllocator.o libjson/_internal/Source/JSONAllocator.cpp

${OBJECTDIR}/libjson/_internal/Source/JSONChildren.o: libjson/_internal/Source/JSONChildren.cpp 
	${MKDIR} -p ${OBJECTDIR}/libjson/_internal/Source
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/libjson/_internal/Source/JSONChildren.o libjson/_internal/Source/JSONChildren.cpp

${OBJECTDIR}/libjson/_internal/Source/JSONDebug.o: libjson/_internal/Source/JSONDebug.cpp 
	${MKDIR} -p ${OBJECTDIR}/libjson/_internal/Source
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/libjson/_internal/Source/JSONDebug.o libjson/_internal/Source/JSONDebug.cpp

${OBJECTDIR}/libjson/_internal/Source/JSONIterators.o: libjson/_internal/Source/JSONIterators.cpp 
	${MKDIR} -p ${OBJECTDIR}/libjson/_internal/Source
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/libjson/_internal/Source/JSONIterators.o libjson/_internal/Source/JSONIterators.cpp

${OBJECTDIR}/libjson/_internal/Source/JSONMemory.o: libjson/_internal/Source/JSONMemory.cpp 
	${MKDIR} -p ${OBJECTDIR}/libjson/_internal/Source
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/libjson/_internal/Source/JSONMemory.o libjson/_internal/Source/JSONMemory.cpp

${OBJECTDIR}/libjson/_internal/Source/JSONNode.o: libjson/_internal/Source/JSONNode.cpp 
	${MKDIR} -p ${OBJECTDIR}/libjson/_internal/Source
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/libjson/_internal/Source/JSONNode.o libjson/_internal/Source/JSONNode.cpp

${OBJECTDIR}/libjson/_internal/Source/JSONNode_Mutex.o: libjson/_internal/Source/JSONNode_Mutex.cpp 
	${MKDIR} -p ${OBJECTDIR}/libjson/_internal/Source
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/libjson/_internal/Source/JSONNode_Mutex.o libjson/_internal/Source/JSONNode_Mutex.cpp

${OBJECTDIR}/libjson/_internal/Source/JSONPreparse.o: libjson/_internal/Source/JSONPreparse.cpp 
	${MKDIR} -p ${OBJECTDIR}/libjson/_internal/Source
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/libjson/_internal/Source/JSONPreparse.o libjson/_internal/Source/JSONPreparse.cpp

${OBJECTDIR}/libjson/_internal/Source/JSONStream.o: libjson/_internal/Source/JSONStream.cpp 
	${MKDIR} -p ${OBJECTDIR}/libjson/_internal/Source
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/libjson/_internal/Source/JSONStream.o libjson/_internal/Source/JSONStream.cpp

${OBJECTDIR}/libjson/_internal/Source/JSONValidator.o: libjson/_internal/Source/JSONValidator.cpp 
	${MKDIR} -p ${OBJECTDIR}/libjson/_internal/Source
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/libjson/_internal/Source/JSONValidator.o libjson/_internal/Source/JSONValidator.cpp

${OBJECTDIR}/libjson/_internal/Source/JSONWorker.o: libjson/_internal/Source/JSONWorker.cpp 
	${MKDIR} -p ${OBJECTDIR}/libjson/_internal/Source
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/libjson/_internal/Source/JSONWorker.o libjson/_internal/Source/JSONWorker.cpp

${OBJECTDIR}/libjson/_internal/Source/JSONWriter.o: libjson/_internal/Source/JSONWriter.cpp 
	${MKDIR} -p ${OBJECTDIR}/libjson/_internal/Source
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/libjson/_internal/Source/JSONWriter.o libjson/_internal/Source/JSONWriter.cpp

${OBJECTDIR}/libjson/_internal/Source/internalJSONNode.o: libjson/_internal/Source/internalJSONNode.cpp 
	${MKDIR} -p ${OBJECTDIR}/libjson/_internal/Source
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/libjson/_internal/Source/internalJSONNode.o libjson/_internal/Source/internalJSONNode.cpp

${OBJECTDIR}/libjson/_internal/Source/libjson.o: libjson/_internal/Source/libjson.cpp 
	${MKDIR} -p ${OBJECTDIR}/libjson/_internal/Source
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/libjson/_internal/Source/libjson.o libjson/_internal/Source/libjson.cpp

${OBJECTDIR}/main.o: main.cpp 
	${MKDIR} -p ${OBJECTDIR}
	${RM} "$@.d"
	$(COMPILE.cc) -g -w -MMD -MP -MF "$@.d" -o ${OBJECTDIR}/main.o main.cpp

# Subprojects
.build-subprojects:

# Clean Targets
.clean-conf: ${CLEAN_SUBPROJECTS}
	${RM} -r ${CND_BUILDDIR}/${CND_CONF}
	${RM} ${CND_DISTDIR}/${CND_CONF}/${CND_PLATFORM}/raspberryserver

# Subprojects
.clean-subprojects:

# Enable dependency checking
.dep.inc: .depcheck-impl

include .dep.inc
